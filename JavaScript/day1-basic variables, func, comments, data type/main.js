  // my alert function
  /*
    many lines or block code comments here
  */
/*   alert("Hi I am JS...");
  console.log("i test you");
  console.log(100);
  console.log(100.102);
  console.log("Number is:" + 100);
  console.log(100+ "5");
  console.log(100+ 5);
  console.log("100"+ 5);
  console.log("100"+ "5");
  alert("second alert"); */

  // variable
  /* var firstName = "Ariful";
  var lastName = "Islam";
  firstName = "MD"; */
  /* // alert(firstName);
  var person = {
    firstName: "Ariful",
    lastName: "Islam",
    age: 28,
    color: "brown",
    gender: "male",
  }
  console.log(person.firstName+ " " +person.lastName + " " + person.age);

  console.log(1+1); */

// adding user to addUser function
function addUser() {
  var users = [
    "Zoya Ebrahimi",
    "Mohammad ismail"
  ];

 var newUser = document.getElementById("userName").value;
 users.push(newUser);
 console.log(users);
 document.getElementById("userList").innerHTML = users;
}
// string Array 
var dciStudents = [
  "Zoya",
  "Malla",
  "Belous",
  "Niki",
  "Ayman",
  "Ahmed",
  "Mansour",
  "Anton",
  "Sascha",
  "Michael",
  "Mohammad"
];
dciStudents.push("ariful");
//console.log(dciStudents);
document.write(dciStudents[0]+dciStudents[8]);

function myText() {
  document.getElementById("demo").style.color = "red";
  document.getElementById("demo").innerHTML = "thanks lot";
  var firstName = document.getElementById("firstName").value;
  var lastName = document.getElementById("lastName").value;
  console.log(firstName);
  console.log(lastName);

  var fullName = firstName + " " + lastName;
  console.log(fullName);
  document.getElementById("myName").innerHTML = fullName;

  var age = document.getElementById("age").value;
  console.log(age);

  var person = {
      firstName: firstName,
      lastName: lastName,
      fullName: fullName,
      age: age,
      favMovies: "terminator"
  }
  document.getElementById("allData").innerHTML = JSON.stringify(person);
  console.log(person);

  // string type of data
  var myString = "my first string";
  // number type
  var myNumber = 100;
  // decimal type
  var myDecimal = 100.01;
  // null/undefined data
  var myNull;

  // string Array
  var myArray = [1,2,4,5,6];
  console.log(myArray[0]);

  // object type data
  var person = {
    name: 'myname',
    age: 21,
    color: "brown"
  }

}

// test reserved variable
// var class = "";

//boolean type variable
var x = true;
var y = true;
console.log(x==y);