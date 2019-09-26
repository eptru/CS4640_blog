import { Component } from '@angular/core';
import { url } from './url';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  
  title = "Click to see a mystery blog";
  
  responsedata = [];
  //responsedata = "";
  
  booleanVar = 0;
  
  index = 0;
  
  constructor(private http: HttpClient) { }
  
  getData() {
	  
	  var data = [];

	this.booleanVar = 1;

     // this.http.get('http://localhost/cs4640/ngphp-get.php?str='+encodeURIComponent(params))
     // this.http.get<Order>('http://localhost/cs4640/ngphp-get.php?str='+params)
     this.http.post<url>('http://localhost/CS4640/New_folder/randompost.php', data).subscribe((data) => {
 
		console.log('Got data from backend', data);
		
        this.responsedata = data["content"];
		
     }, (error) => {
        console.log('Error', error);
     })
	 
	return true; 
	
	
	 
  }
 
  
}
