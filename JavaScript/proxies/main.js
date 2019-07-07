/* works in between object and code
 * basic structure and declare: new Proxy(target, handler)
 */
/* let myProxy = new Proxy(target, handler);
console.log(myProxy);  */

let person = {
    _name: "arif",
    _age: 30,
    get name() {
        return this._name;
    },
    get age() {
        return this._age;
    },
    set age(newAge) {
        this._age = newAge;
    }
}
/* console.log(person.age);
person.age = 100;
console.log(person.age);
console.log(person.country); */

let person2 = {
    name: "arif",
    age: 30
}

const doSome = {
    get: (obj, key)=> {
        key in obj ? obj[key] : 'Nothing';
    },
    set: (obj, key, value) => {
        obj[key] = value;
    }
}

let myProxy = new Proxy(person2, doSome);
console.log(myProxy.age);
myProxy.age = 100;
console.log(myProxy.age);
console.log(myProxy.name);
console.log(myProxy.country);


