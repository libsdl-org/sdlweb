<?PHP
 include ("../include/login.inc.php");
 include ($header_filename);
?>
<h1>SDL Summer of Code Ideas</h1>

<blockquote style="color: #414141">

<p>
This page is a scratch pad of ideas for the <a href="http://www.google-melange.com/">Google Summer of Code</a>.  The general theme this year is creating a top quality SDL release.
</p>

<ul>
<li> Code Quality <br>
The idea of this project is to use any available software validation tools to improve the existing SDL 1.3 codebase. The student would apply static analysis to SDL 1.3 sourcecode using tools such as BLAST, Splint or cppcheck, a task which may include creating custom rulesets. Compiler warnings from different build environments should be analyzed and fixed. Memory leak detection and validation would be performed using existing SDL tests or games to find problems. Once issues have been found the student would need to fix or improve the code. The task would also include documentation of the validation procedures on the SDL wiki, communication of the issues found to the community via the mailing list so others can learn from the found issues, or even soliciting commercial companies to provide free donations of validation products to the SDL project.
</li>
<br>
<li> Test Coverage <br>
The idea of this project is to develop an automated test suite for SDL. The student would need to research and integrate a test harness such as CppUnit. The student would develop a test framework with features useful for SDL such as the ability to perform validations via screen captures and pixel-level checks, gather performance metrics, generate HTML based reports and run on multiple platforms. With this in place, the student would consequently develop test programs that validate the SDL API or check the documented functionality. The tests that the student will develop can also include fault injection tests, fuzzing, boundary analysis, globalization tests, performance tests, or any other method deemed valuable or interesting. Once issues have been found the student would need to file a bug report or fix the code. The task would also include the documentation of the test framework or suites on the SDL wiki, communication of the issues found to the community via the mailing list so others can learn from the found issues.
</li>
</ul>

</blockquote>

<?PHP
 include ("footer.inc.php");
?>
