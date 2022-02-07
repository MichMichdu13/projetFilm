const width = window.getComputedStyle(document.querySelector('#starGold')).getPropertyValue('width');

document.querySelector( "#rate1").addEventListener("mouseover", function(){
    document.querySelector( "#starGold" ).style.width= "20%";
});
document.querySelector( "#rate1").addEventListener('mouseleave', function (){
    document.querySelector( "#starGold" ).style.width= width;
});

document.querySelector( "#rate2").addEventListener("mouseover", function(){
    document.querySelector( "#starGold" ).style.width= "40%";
});
document.querySelector( "#rate2").addEventListener('mouseleave', function (){
    document.querySelector( "#starGold" ).style.width= width;
});

document.querySelector( "#rate3").addEventListener("mouseover", function(){
    document.querySelector( "#starGold" ).style.width= "60%";
});
document.querySelector( "#rate3").addEventListener('mouseleave', function (){
    document.querySelector( "#starGold" ).style.width= width;
});

document.querySelector( "#rate4").addEventListener("mouseover", function(){
    document.querySelector( "#starGold" ).style.width= "80%";
});
document.querySelector( "#rate4").addEventListener('mouseleave', function (){
    document.querySelector( "#starGold" ).style.width= width;
});
document.querySelector( "#rate5").addEventListener("mouseover", function(){
    document.querySelector( "#starGold" ).style.width= "100%";
});
document.querySelector( "#rate5").addEventListener('mouseleave', function (){
    document.querySelector( "#starGold" ).style.width= width;
});
