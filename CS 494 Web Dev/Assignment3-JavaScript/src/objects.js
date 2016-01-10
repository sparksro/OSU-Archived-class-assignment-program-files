/**
 * Create an object literal with the following key value pairs:
 * type: {string} 'Goldfish'
 * brand: {string} 'Pepperidge Farm'
 * flavor: {string} 'Cheddar'
 * count: {number} 2000
 * It should be returned direcly by the following function
 * @return {object} - the object literal
 */
//your code here

var objectLiteral = {
	type : 'Goldfish',
	brand : 'Pepperidge Farm',
	flavor : 'Cheddar',
	count : 2000
};

function returnObjectLiteral() {
	"use strict";
	return objectLiteral; //Modify ONLY this line
}

//end your code


/**
 * Create a constructor function for a `Cat` object.
 * @constructor
 * @param {string} name - The name of the cat as a string
 * @param {string} color - The color of the cat
 * The above values should be stored and be accessable via the name and color
 * properties respectively. In addition, the following methods should be
 * callable on a Cat object:
 * destroyFurniture({string} name, {number} cost) - adds a piece of destroyed
 * furnature
 * lastDestroyedFurniture() - returns a object with two key value pairs with
 * keys 'name' and 'cost' and values corrisponding to the name and cash money
 * value of the last item destroyed.
 * totalDestroyed() - returns a {number} that is the total value of destroyed
 * furnature.
 * nthDestroyed( {number} n ) - Returns the nth destroyed furnature. 0 should
 * return the first item destroyed, 1 the second and so on. It should return it
 * as an object just as lasatDestroyedFurniture does.
 */

//your code here

// Credit where credit it due: I had some difficultie undestanding this part of the 
//code on my own.  Thanks to the conversation on Piazza Here: https://piazza.com/class/i0j5uszbfur1jw?cid=166
//I was able to get my code to work, I think, as it should.  All my tests seem to work.

function Cat(name, color) {
  this.name = name;
  this.color = color;
  this.destroyedFurniture = [];
  this.destroyFurniture = function (fname, cost) { 
  this.destroyedFurniture.push({ fname: name, cost: cost }); 
  };
  
Furniture = function(name, cost){
  this.fname = fname;
  this.cost = cost;
  }  
  
this.lastDestroyedFurniture = function() { 
   return (this.destroyedFurniture[this.destroyedFurniture.length -1]);
  };
  
this.totalDestroyed = function() {
    var totalCost = 0;
    for (var i = 0; i < this.destroyedFurniture.length; i++) {
      totalCost += this.destroyedFurniture[i].cost;
    }
    return totalCost;
  };
  
this.nthDestroyed = function(n) {
    for (var i = 0; i < n; i++) {
    return this.destroyedFurniture[i]; 
     } };
}


//end your code

/**
 * Create an instance of a 'Orange' cat with the name 'Maru' stored in a variable
 * called myCat. Call the destroyFurniture function on at least $1000 of
 * furniture.
 */

//your code here

var myCat = new Cat("Maru","Orange");

myCat.destroyFurniture("chair", 300 );
myCat.destroyFurniture("table", 600 );
myCat.destroyFurniture("chair", 400 );

//tests
//console.log(myCat.name);
//console.log(myCat.color);
//console.log(myCat.lastDestroyedFurniture());   
//console.log(myCat.totalDestroyed());



//end your code

/**
 * Add a method to the cat prototype called 'pet'. This function should accept
 * a {number} n as an argument. If that {number} is greater than 2.5 it should
 * return the {string} 'CLAW!' if that {number} is less than or equal to 2.5
 * it should return the {string} 'Purr.'.
 * @param {number} n - The number of pets
 * @return {string} - The cats reaction.
 */
//your code here

Cat.prototype.pet = function(n){
    if (n > 2.5){
        return "CLAW!";}
    if (n <= 2.5){
       return "Purr."; 
    }
};
//test
myCat.pet(2);


//end your code

