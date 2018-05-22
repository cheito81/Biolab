/**
* @name: Aplication
* @author: Jose Gimenez & Hector Garcia
* @version: 3.1
* @description: class Aplication
* @date: 17/05/2017
*/
function Aplication () {
	//Attributes declaration
	this.id;
	this.userID;
	this.position;
	this.startDate;
	this.url;
	this.salary;
	this.hobbies=[];
	this.relocate;
	this.reasons;


	//Methods declaration
	this.construct = function (id,userId,position,startDate,url,salary,hobbies,relocate,reasons)	{
		this.setId(id);
		this.setUserId(userId);
		this.setPosition(position);
		this.setStartDate(startDate);
		this.setUrl(url);
		this.setSalary(salary);
		this.setHobbies(hobbies);
		this.setRelocate(relocate);
		this.setReasons(reasons);
	};

	this.setId = function (id){this.id=id;};
	this.setUserId = function (userId){this.userId=userId;};
	this.setPosition = function (position){this.position=position;};
	this.setStartDate = function (startDate){this.startDate=startDate;};
	this.setUrl = function (url){this.url=url;};
	this.setSalary = function (salary){this.salary=salary;};
	this.setHobbies = function (hobbies){this.hobbies=hobbies;};
	this.setRelocate = function (relocate){this.relocate=relocate;};
	this.setReasons = function (reasons){this.reasons=reasons;};

	this.getId = function () {return this.id;};
	this.getUserId = function (){return this.userId;};
	this.getPosition = function () {return this.position;};
	this.getStartDate = function () {return this.startDate;};
	this.getUrl = function () {return this.url;};
	this.getSalary = function (){return this.salary;};
	this.getHobbies = function () {return this.hobbies;};
	this.getRelocate = function () {return this.relocate;};
	this.getReasons = function () {return this.reasons;};

	/**
  * @name: toString()
  * @author: Jose Gimenez & Hector Garcia
  * @version: 3.1
  * @description: converts all object to string
  * @date: 17/05/2017
  */
	this.toString = function () {
		var userString ="id="+this.getId()+" userId="+this.getUserId()+" position="+this.getPosition()+" startDate="+this.getStartDate()+" url="+this.getUrl();
		userString +=" salary"+this.getSalary()+" hobbies="+this.getHobbies()+" realocate="+this.getRelocate()+" reasons="+this.getReasons();
		return userString;
	};

	/**
  * @name: addHobbies()
  * @author: Jose Gimenez & Hector Garcia
  * @version: 3.1
  * @description: add hobbie into hobbies array
  * @date: 17/05/2017
  */
	this.addHobbies = function (hobbie)	{
		this.hobbies.push(hobbie);
	};

	/**
  * @name: removeHobbies()
  * @author: Jose Gimenez & Hector Garcia
  * @version: 3.1
  * @description: remove hobbie from hobbies array
  * @date: 17/05/2017
  */
	this.removeHobbies = function (hobbie)
	{
		for (var i = 0; i < this.getHobbies().length; i++)
		{
			if(this.getHobbies()[i]==hobbie)
			{
				this.hobbies.splice(i,1);
				break;
			}
		}

	};

	/**
  * @name: hobbiesToString()
  * @author: Jose Gimenez & Hector Garcia
  * @version: 3.1
  * @description: convert object to string
  * @date: 17/05/2017
  */
	this.hobbiesToString = function () {
		var stringHobbies = "";
		if(this.getHobbies().length === null){
			for (var i = 0; i < this.getHobbies().length; i++) {
				if (i + 1 == this.getHobbies().length) {
					stringHobbies += this.hobbies[i];
				}
				else {
					stringHobbies += this.hobbies[i] + ", ";
				}
			}
			this.hobbies = "";
			this.hobbies = stringHobbies;
		} else {
			this.hobbies = null;
		}
	};

}
