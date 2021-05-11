# Developers-test

We have prepared you a simple test task, that we believe, allows us to estimate your experience.
It is a small php-script, which should be started in console like:

`php console.php --action {action}  --file {file}`

The script will take two required parameters:

`{file}` - csv-source file with numbers, where each row contains two numbers between -100 and 100, and

`{action}` - what action should we do with numbers from `{file}`, and can take next values:

<ul>
<li><b>plus</b> - to count sum of the numbers on each row in the {file}</li>
<li><b>minus</b> - to count difference between first number in the row and second</li>
<li><b>multiply</b> - to multiply the numbers on each row in the {file} </li>
<li><b>division</b> - to divide first number in the row and second</li>
</ul>


As a result of the command execution, you should get a csv file with three columns: first number, second number, and result. In CSV-file should be written **ONLY** numbers greater than null (maybe zero). If the result less than null - it should be written in logs.

**Example 1**

`php console.php --action plus  --file {file}`, where in file you can find next numbers:

10 20 <br/>
-30 20 <br/>
-3 5 <br/>

As result in CSV file you should write:

10 20 30 <br/>
-3 5 2

And in the log file, something like "_numbers are - 30 and 20 are wrong_"

**Example 2**

`php console.php --action division  --file {file}`, where in file you can find next numbers:

20 10 <br/>
-30 20 <br/>
3 0 <br/>

As result in CSV file you should write:

20 10 2 <br/>

And in log file, something like:

_numbers are -30 and 20 are wrong_ <br/>
_numbers are 3 and 0 are wrong, is not allowed_ <br/>

##Task
You need to refactor the code and write it the proper way. Just do your best: update/delete/add code as you wish.


###Requirements

*After refactoring code shoud work</li>
*Code should work on PHP7.2+</li>
*As file source example please use test.csv</li>

###Result
Please put the result of your work in your Github or Bitbucket account, and send a link back.

