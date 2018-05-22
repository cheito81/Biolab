function User() {
  //Attributes declaration
  this.id;
  this.name;
  this.surname1;
  this.nick;
  this.password;
  this.address;
  this.telephone;
  this.mail;
  this.birthDate;
  this.entryDate;
  this.dropOutDate;
  this.active;
  this.image;
  this.city;
  this.state;
  this.userType;


  //methods declaration
  this.construct = function (id, name, surname1, nick, password, userType, address, city,state, telephone, mail, birthDate, entryDate, dropOutDate, active, image) {
    this.setId(id);
    this.setName(name);
    this.setSurname1(surname1);
    this.setNick(nick);
    this.setPassword(password);
    this.setUserType(userType);
    this.setAddress(address);
    this.setCity(city);
    this.setState(state);
    this.setTelephone(telephone);
    this.setMail(mail);
    this.setBirthDate(birthDate);
    this.setEntryDate(entryDate);
    this.setDropOutDate(dropOutDate);
    this.setActive(active);
    this.setImage(image);
  };

  //setters
  this.setId = function (id) {this.id=id;};
  this.setName = function (name) {this.name=name;};
  this.setSurname1 = function (surname1) {this.surname1=surname1;};
  this.setNick = function (nick) {this.nick=nick;};
  this.setPassword = function (password) {this.password=password;};
  this.setUserType = function (userType) {this.userType=userType;};
  this.setAddress = function (address) {this.address=address;};
  this.setCity = function (city) {this.city=city;};
  this.setState = function (state) {this.state=state;};
  this.setTelephone = function (telephone) {this.telephone=telephone;};
  this.setMail = function (mail) {this.mail=mail;};
  this.setBirthDate = function (birthDate) {this.birthDate=birthDate;};
  this.setEntryDate = function (entryDate) {this.entryDate=entryDate;};
  this.setDropOutDate = function (dropOutDate) {this.dropOutDate=dropOutDate;};
  this.setActive = function (active) {this.active=active;};
  this.setImage = function (image) {this.image=image;};

  //getters
  this.getId = function () {return this.id;};
  this.getName = function () {return this.name;};
  this.getSurname1 = function () {return this.surname1;};
  this.getNick = function () {return this.nick;};
  this.getPassword = function () {return this.password;};
  this.getUserType = function () {return this.userType;};
  this.getAddress = function () {return this.address;};
  this.getCity = function () {return this.city;};
  this.getState = function () {return this.state;};
  this.getTelephone = function () {return this.telephone;};
  this.getMail = function () {return this.mail;};
  this.getBirthDate = function () {return this.birthDate;};
  this.getEntryDate = function () {return this.entryDate;};
  this.getDropOutDate = function () {return this.dropOutDate;};
  this.getActive = function () {return this.active;};
  this.getImage = function () {return this.image;};

  /*
  * @name: toString()
  * @author:
  * @version: 3.1
  * @description: convert object to string
  * @date: 04/03/2015
  */
  this.toString = function () {
    var userString ="id="+this.getId()+" name="+this.getName()+" surname="+this.getSurname1()+" nick="+this.getNick()+" password="+this.getPassword()+" userType"+this.getUserType();
    userString +=" address="+this.getAddress()+" city="+this.getCity()+" satate="+this.getState()+" telephone="+this.getTelephone()+" mail="+this.getMail();
    userString +=" birth date="+this.getBirthDate()+" up date="+this.getEntryDate()+" out date="+this.getDropOutDate()+" active="+this.getActive()+" image="+this.getImage();
    return userString;
  };
}
