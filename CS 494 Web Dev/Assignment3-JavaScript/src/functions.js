/**
* the \@param notation indicates an input paramater for a function. For example
* @param {string} foobar - indicates the function should accept a string
* and it should be called foobar, for example function(foobar){}
* \@return is the value that should be returned
*/

/**
* Write a function called `uselessFunction`.
* It should accept no arguments.
* It should return the string primitive 'useless'.
* @return {string} - 'useless'.
*/

//your code here

function uselessFunction() {
	var str ="useless";
	return (str);
}
//uselessFunction();

//end your code

var bar = 'not a function';
var barType = typeof bar;

/**
* Assign the above variable 'bar' to an anonymous function.
* @param {doubleArray|number} doubleArray - an aray of numbers.
* The function should multiply every number in the array by 2 (this should
* change the content of the array).
* @return {boolean} - true if the operation was sucessful, false otherwise.
* This should return false if a value in the array cannot be doubled.
*/

//your code here

//test array and print
//myArray = [5,7,10,14,42]; 
//for(var i = 0; i < myArray.length ; i++){
   //console.log(myArray[i]);
   // }
    
function doubleArray(bar){   
for(var i = 0; i < myArray.length ; i++){
   temp = (myArray[i]);
   (myArray[i]) = ((myArray[i]) *2);
   //console.log("Array position -"+ i, "double = "+ ((myArray[i]/2) == temp));
    console.log((myArray[i]/2) == temp);
    }
}
//test call and print
//doubleArray();
//for(var i = 0; i < myArray.length ; i++){
   //console.log(myArray[i]);
    //}
//end your code

/**
* Create a function to parse email addresses called emailParse
* @param {array.<string>} emailArray - an array of email address strings of the
* format [local]@[domain].[gTLD]
* a gTLD is a generic top-level domain (ex. com, edu, gov). The original arrray
* should remain unchanged.
* @return {array.<array.<string>>} - return an array of 3 arrays. The arrays
* should
* contain the local, domin and gTLD's respectivley. return[0] should be an
* array of local parts. return[0][5] + '@' + return[1][5] + '.' + return[2][5]
* should reconstruct the 5th email address.
*/
//your code here

//test arrays
    //var emailArr = ["me@here.gTLD","you@here.gTLD","bob@there.com","joe@there.gTLD","sally@herethere.gTLD"];
   //var emailArr2 = ["herold@here.gTLD","joe@here.gTLD","susan@there.com","marye@there.gTLD","sally@herethere.gTLD","Katty@there.com"]; 
    
function emailParse(passedEmArr){    
    var inputNum = passedEmArr.length;
    //make the multi arry to store parts
    EMparts = new Array(inputNum);
        for(var x = 0; x < inputNum; x++){
        EMparts[x] = new Array(3);}
    
    for(var y = 0; y < inputNum; y++){
    //split off local form the rest and assign it to localParse
        var temphp1 = passedEmArr[y].split('@');
        var localParse = temphp1[0];
    //take the rest of the string split by the . and
    //assign to hostParse and domainParse
        var temphp2 = temphp1[1].split('.');
        var hostParse = temphp2[0];
        var domainParse = temphp2[1];
    //console.log(localParse+" "+hostParse+" "+domainParse);
            EMparts[y][0] = localParse;
            EMparts[y][1] = hostParse;
            EMparts[y][2] = domainParse;
        }
    for(var i = 0; i < inputNum; i++){
        //console.log("Array of parts at "+i+": " +EMparts[i]);
        console.log(EMparts[i]);
        for(var k = 0; k < 3; k++){
            //console.log("   Part "+k+" ->"+EMparts[i][k]);
            console.log(EMparts[k][i]);
        }
    }
}

emailParse(emailArr2);
//end your code

