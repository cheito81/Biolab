function User() {
  //Attributes declaration
  this.id;
  this.name;
  this.surname1;
  this.nick;
  this.password;
  this.mail;
  this.entryDate;
  this.image;
  this.userType;


  //methods declaration
  this.construct = function (id, name, surname1, nick, password, userType, mail, entryDate, image) {
    this.setId(id);
    this.setName(name);
    this.setSurname1(surname1);
    this.setNick(nick);
    this.setPassword(password);
    this.setUserType(userType);
    this.setMail(mail);
    this.setEntryDate(entryDate);
    this.setImage(image);
  };

  //setters
  this.setId = function (id) {this.id=id;};
  this.setName = function (name) {this.name=name;};
  this.setSurname1 = function (surname1) {this.surname1=surname1;};
  this.setNick = function (nick) {this.nick=nick;};
  this.setPassword = function (password) {this.password=password;};
  this.setUserType = function (userType) {this.userType=userType;};
  this.setMail = function (mail) {this.mail=mail;};
  this.setEntryDate = function (entryDate) {this.entryDate=entryDate;};
  this.setImage = function (image) {this.image=image;};

  //getters
  this.getId = function () {return this.id;};
  this.getName = function () {return this.name;};
  this.getSurname1 = function () {return this.surname1;};
  this.getNick = function () {return this.nick;};
  this.getPassword = function () {return this.password;};
  this.getUserType = function () {return this.userType;};
  this.getMail = function () {return this.mail;};
  this.getEntryDate = function () {return this.entryDate;};
  this.getImage = function () {return this.image;};

  /*
  * @name: toString()
  * @author:
  * @version: 3.1
  * @description: convert object to string
  * @date: 04/03/2015
  */
  this.toString = function () {
    var userString ="id="+this.getId()+" name="+this.getName()+" surname="+this.getSurname1()+" nick="+this.getNick()+" password="+this.getPassword()+" userType"+this.getUserType()+" mail="+this.getMail();
    userString +=" up date="+this.getEntryDate()+" active="+this.getActive()+" image="+this.getImage();
    return userString;
  };
}
