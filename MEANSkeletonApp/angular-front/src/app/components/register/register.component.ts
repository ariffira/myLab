import { Component, OnInit } from '@angular/core';
import { ValidateService } from '../../services/validate.service';
import { AuthService } from '../../services/auth.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  name: String;
  email: String;
  username: String;
  password: String;


  constructor(
    private validateService: ValidateService,
    private authService:AuthService,
    private router:Router
  ) { }

  ngOnInit() {
  }

  onRegisterSubmit() {
    // console.log(this.name);// check ngmodel data binding
    const user = {
      name: this.name,
      email: this.email,
      username: this.username,
      password: this.password
    }
    // Validate required fields
    if (!this.validateService.validateRegister(user)){
      console.log('please fill in');
      return false;
    }

    // Email validate
    if(!this.validateService.validateEmail(user.email)) {
      console.log('Please use a valid email');
      return false;
    }

    // Register user
    // subscribe the observable
    this.authService.registerUser(user).subscribe(data => {
      if(data.success){
        alert('OK');
        this.router.navigate(['/login']);
      } else {
        alert('Not OK');
        this.router.navigate(['/register']);
      }
    });
  }

}
