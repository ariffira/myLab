// alert('Hi ..........');
/* console.log('Hi ..........helo...this is my js coding practice at dci'); */
// declaration variables
var firstName, lastName, fullName, notDefined, checkMyName; 
var webSiteName = "www.mysite.com";
webSiteName = "<hr><h3>www.changedname.com</h3>"; 

// defining variables
firstName = "MD Ariful";
lastName = "ISLAM";
fullName = firstName + " " +lastName;
mystring = "hello";
nullValue = null;

// browser display
document.write(firstName + "<br>");
document.write("<h2 style='color:red;'>" + lastName + "</h2>");
document.write("<br><h1>" + fullName + "</h1>");
document.write("<br>" + notDefined); //undefined
document.write("<br>" + mystring / 400); //NaN
document.write(nullValue);
document.write(webSiteName);

//console display
console.log(firstName);
console.log(firstName + "," + lastName);
console.log(lastName);
console.log(fullName);
console.log(checkMyName); //undefined
console.log(mystring / 400); //NaN
console.log(nullValue);

// let variable
var country = "Germany";
{
  //change let to var, const and see differences
  let country = "Bangladesh"; 
  console.log(country);
}
country = "Polland"; 
console.log(country);

// array type variable
var myFriendList = [

  "Michael Mueller", //0
  "Zoya Ahsan",//1
  "Ismail Hossain",//2
  "Niki Carlos"//3
];

//console.log(myFriendList[2]);

// push() add value in array at last position
myFriendList.push("MD Ariful Islam");
console.log(myFriendList);

// pop() delete value from array at last position
myFriendList.pop();
console.log(myFriendList);

// unshift() add first position of array at first position
myFriendList.unshift("Dark Knight");
console.log(myFriendList);

// shift() delete first array value at first position
myFriendList.shift();
console.log(myFriendList);

// adding two values method
// addition(4,3);
function addition() {
  var b = parseInt(document.getElementById("valueOfx").value);
  var c = parseInt(document.getElementById("valueOfy").value);
  var z = b + c;
  document.getElementById("addId").innerHTML = z;
  console.log(z);
}

// deleting one value from another
function subtraction() {
  var a = document.getElementById("valueOfx").value;
  var b = document.getElementById("valueOfy").value;
  var c = a - b;
  document.getElementById("minusId").innerHTML = c;
  console.log(c);
}

// multiply one value with another
function multiplication() {
  var a = document.getElementById("valueOfx").value;
  var b = document.getElementById("valueOfy").value;
  var c = a * b;
  document.getElementById("multiplyId").innerHTML = c;
  console.log(c);
}

// devide one value with another
function division() {
  var a = document.getElementById("valueOfx").value;
  var b = document.getElementById("valueOfy").value;
  var c = a / b;
  document.getElementById("devisionId").innerHTML = c;
  console.log(c);
}

// reminder value
function reminder() {
  var a = document.getElementById("valueOfx").value;
  var b = document.getElementById("valueOfy").value;
  var c = a % b;
  document.getElementById("reminderId").innerHTML = c;
  console.log(c);
}

// increment value
function increment() {
  var a = document.getElementById("valueOfx").value;
  a ++; // add 1 to the a value
  //a += 10; // add 10 to the a value
  document.getElementById("incrementId").innerHTML = a;
  console.log(a);
}

// increment value
function increment() {
  var a = document.getElementById("valueOfx").value;
  a ++; // add 1 to the a value
  //a += 10; // add 10 to the a value
  document.getElementById("incrementId").innerHTML = a;
  console.log(a);
}

// decrement value
function decrement() {
  var a = document.getElementById("valueOfx").value;
  a --; // delete 1 to the a value
  document.getElementById("incrementId").innerHTML = a;
  console.log(a);
}


