// js generators structure
function * myGen() {
    //console.log('My first Generator function');
}
// invoke gen function by next() method, next will show all value one by one
myGen().next(); //shows console msg 

// control loops
function* loopControl() {
    for(let i=0; i<2; i++) {
        //yield console.log(i + ' is the value of loop ' + (i+1));
    }
}
let test = loopControl();
loopControl().next(); // display 0
loopControl().next(); // display 0
test.next(); // display 0
test.next(); // display 1 
test.next(); // display 2 

/*
 * yield vs return
 * many yields will work
 * many return will not work
 * after 1st return no return or yield will work
 */
function *manyYield(a, b) {
    yield a+b;
    // return a + b; // uncomment and check the differences
    yield a-b;
    yield a*b;
    yield a/b;
}

const manyYieldVar = manyYield(5, 10);
// need value because it only return
console.log(manyYieldVar.next().value); // 15
console.log(manyYieldVar.next().value); // -5
console.log(manyYieldVar.next().value); // 50
console.log(manyYieldVar.next().value); // 0.5
console.log(manyYieldVar.next().value); // undefined
console.log(manyYieldVar.next()); // whole object with msg and value

// chaining in generators
function* childGen(i) {
  yield i * 10;
}

function * parentGen() {
    let i = 5;
    yield* childGen(i);
}

let parent = parentGen();
console.log(parent.next().value);

 
