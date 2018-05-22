/**
*  @name Review
*  @author Hector Garcia Guillen
*  @version: 3.1
*  @date: 17/05/2017
*  @description Defines the structure of the product object and contains the methods used to construct the object and access it.
*/
function Review (){
  //Properties
  this.id;
  this.userId;
  this.rate;
  this.opinion;


  //Methods
  //Constructor
  this.construct = function (id, userId, rate, opinion)  {
    this.id = id;
    this.userId=userId;
    this.rate = rate;
    this.opinion = opinion;
  };

  this.getId = function ()  {
    return this.id;
  };

  this.getUserId = function ()  {
    return this.userId;
  };

  this.getRate = function ()  {
    return this.rate;
  };

  this.getOpinion = function ()  {
    return this.opinion;
  };


  this.setId = function (id)  {
    this.id = id;
  };

  this.setUserId = function (userId)  {
    this.userId = userId;
  };

  this.setRate = function (rate)  {
    this.rate = rate;
  };

  this.setOpinion = function (opinion)  {
    this.opinion = opinion;
  };


}
