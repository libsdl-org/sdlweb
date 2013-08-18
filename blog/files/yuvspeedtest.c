
#include <stdlib.h>
#include <stdio.h>

#include "SDL.h"

/* Call this instead of exit(), so we can clean up SDL: atexit() is evil. */
static void
quit(int rc)
{
    SDL_Quit();
    exit(rc);
}

/* NOTE: These RGB conversion functions are not intended for speed,
         only as examples.
*/

void
RGBtoYUV(Uint8 * rgb, int *yuv, int monochrome, int luminance)
{
    if (monochrome) {
#if 1                           /* these are the two formulas that I found on the FourCC site... */
        yuv[0] = (int)(0.299 * rgb[0] + 0.587 * rgb[1] + 0.114 * rgb[2]);
        yuv[1] = 128;
        yuv[2] = 128;
#else
        yuv[0] = (int)(0.257 * rgb[0]) + (0.504 * rgb[1]) + (0.098 * rgb[2]) + 16;
        yuv[1] = 128;
        yuv[2] = 128;
#endif
    } else {
#if 1                           /* these are the two formulas that I found on the FourCC site... */
        yuv[0] = (int)(0.299 * rgb[0] + 0.587 * rgb[1] + 0.114 * rgb[2]);
        yuv[1] = (int)((rgb[2] - yuv[0]) * 0.565 + 128);
        yuv[2] = (int)((rgb[0] - yuv[0]) * 0.713 + 128);
#else
        yuv[0] = (0.257 * rgb[0]) + (0.504 * rgb[1]) + (0.098 * rgb[2]) + 16;
        yuv[1] = 128 - (0.148 * rgb[0]) - (0.291 * rgb[1]) + (0.439 * rgb[2]);
        yuv[2] = 128 + (0.439 * rgb[0]) - (0.368 * rgb[1]) - (0.071 * rgb[2]);
#endif
    }

    if (luminance != 100) {
        yuv[0] = yuv[0] * luminance / 100;
        if (yuv[0] > 255)
            yuv[0] = 255;
    }
}

void
ConvertRGBtoYV12(Uint8 *rgb, Uint8 *out, int w, int h,
                 int monochrome, int luminance)
{
    int x, y;
    int yuv[3];
    Uint8 tmp;
    Uint8 *op[3];

    op[0] = out;
    op[1] = op[0] + w*h;
    op[2] = op[1] + w*h/4;
    for (y = 0; y < h; ++y) {
        for (x = 0; x < w; ++x) {
            /* Swap R and B */
            tmp = rgb[0];
            rgb[0] = rgb[2];
            rgb[2] = tmp;

            RGBtoYUV(rgb, yuv, monochrome, luminance);
            *(op[0]++) = yuv[0];
            if (x % 2 == 0 && y % 2 == 0) {
                *(op[1]++) = yuv[2];
                *(op[2]++) = yuv[1];
            }
            rgb += 3;
        }
    }
}

int
main(int argc, char **argv)
{
    SDL_Window *window;
    SDL_Renderer *renderer;
    SDL_RendererInfo info;
    SDL_Surface *image;
    Uint8 *imageYUV;
    SDL_Texture *texture;
    SDL_Event event;
    Uint32 then, now, frames;
    SDL_bool done = SDL_FALSE;

    if (!argv[1]) {
        fprintf(stderr, "Usage: %s file.bmp\n", argv[0]);
        return 1;
    }

    if (SDL_Init(SDL_INIT_VIDEO) < 0) {
        fprintf(stderr, "Couldn't initialize SDL: %s\n", SDL_GetError());
        return 2;
    }

    image = SDL_LoadBMP(argv[1]);
    if (!image) {
        fprintf(stderr, "Couldn't load BMP file %s: %s\n", argv[1], SDL_GetError());
        quit(3);
    }
    if (image->format->BytesPerPixel != 3) {
        fprintf(stderr, "BMP must be 24-bit\n");
        quit(4);
    }

    /* wxh for the V plane, and then w/2xh/2 for the U and V planes */
    imageYUV = SDL_malloc(image->w*image->h+(image->w*image->h)/2);
    ConvertRGBtoYV12(image->pixels, imageYUV, image->w, image->h, 0, 100);

    /* Create the window and renderer */
    window = SDL_CreateWindow("YUV speed test",
                              SDL_WINDOWPOS_UNDEFINED,
                              SDL_WINDOWPOS_UNDEFINED,
                              image->w, image->h,
                              SDL_WINDOW_SHOWN|SDL_WINDOW_RESIZABLE);
    if (!window) {
        fprintf(stderr, "Couldn't set create window: %s\n", SDL_GetError());
        quit(5);
    }

    renderer = SDL_CreateRenderer(window, -1, 0);
    if (!renderer) {
        fprintf(stderr, "Couldn't set create renderer: %s\n", SDL_GetError());
        quit(6);
    }
    SDL_GetRendererInfo(renderer, &info);
    printf("Using %s rendering\n", info.name);

    texture = SDL_CreateTexture(renderer, SDL_PIXELFORMAT_YV12, SDL_TEXTUREACCESS_STREAMING, image->w, image->h);
    if (!texture) {
        fprintf(stderr, "Couldn't set create texture: %s\n", SDL_GetError());
        quit(7);
    }

    /* Main loop */
    frames = 0;
    then = SDL_GetTicks();
    while (!done) {
        while (SDL_PollEvent(&event)) {
            switch (event.type) {
            case SDL_KEYDOWN:
                if (event.key.keysym.sym == SDLK_ESCAPE) {
                    done = SDL_TRUE;
                }
                break;
            case SDL_QUIT:
                done = SDL_TRUE;
                break;
            }
        }

        SDL_UpdateTexture(texture, NULL, imageYUV, image->w);
        SDL_RenderClear(renderer);
        SDL_RenderCopy(renderer, texture, NULL, NULL);
        SDL_RenderPresent(renderer);
        ++frames;
    }

    /* Print out some timing information */
    now = SDL_GetTicks();
    if (now > then) {
        double fps = ((double) frames * 1000) / (now - then);
        printf("%2.2f frames per second\n", fps);
    }

    SDL_DestroyRenderer(renderer);
    quit(0);
    return 0;
}

/* vi: set ts=4 sw=4 expandtab: */
