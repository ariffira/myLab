import { Component, OnInit } from '@angular/core';
import { DataService} from '../../services/data.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
  name: string;
  age: number;
  email: string;
  address: Address;
  hobbies: string[];
  hello: any;
  posts: Post[];

  constructor(private dataService: DataService) { }

  ngOnInit() {
    this.name = 'Shoma';
    this.age = 31;
    this.email = 'arif@gmail.com';
    this.address = {
      street: 'Twingenbergpl',
      city: 'essen',
      state: 'NRW'
    };
    this.hobbies = ['sports', 'coding', 'Movies', 'Sex'];
    this.hello = 'hello';
    this.dataService.getPosts().subscribe((posts) => {
      // console.log(posts);
      this.posts = posts;
    });
  }

  onClick() {
    this.name = 'Tanzina Shoma';
    this.hobbies.push('New Hobby');
  }

  addHobby(hobby) {
    this.hobbies.unshift(hobby);
    return false;
  }

  deleteHobby(hobby) {
    console.log('deleting hobby');
    for (let i = 0; i < this.hobbies.length; i++) {
      if (this.hobbies[i] == hobby) {
        this.hobbies.splice(i, 1);
      }
    }
  }

}

interface Address {
  street: string;
  city: string;
  state: string;
}

interface Post {
  id: number;
  title: string;
  body: string;
  userId: number
}
