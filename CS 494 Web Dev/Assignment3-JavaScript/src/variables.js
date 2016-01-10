/*
Input:
a: a whole, positive number

Output:
plus5: a number that is the sum of 5 and `a`
asString: a string that is just `a` converted to a string
asStringWithFoo: a string that is `a` with the string 'foo' appended
a: the original a number
*/

//var a = 10;
function variableModification(a) {
  var plus5;
  var asString;
  var asStringWithFoo;
  //your code here
  plus5 = 5 + a;
  asString = String(a);
  asStringWithFoo = asString + "foo";
  return [plus5, asString, asStringWithFoo, a];


//variableModification(10);
  //end your code
}

/*
Input:
b: could be anything

Output:
return true if b is a primitive string value, false otherwise
*/
//var b = "5"; 
function isString(b) {
  //your code here
  return(typeof (b) == 'string');  
  //end your code
}
//isString(b);
/*
Input:
c: could be anything

Output:
return true if c is undefined, false otherwise
*/
function isUndefined(c) {
  //your code here
  return(typeof (c) == 'undefined');
  //end your code
}
