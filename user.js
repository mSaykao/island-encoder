var clock = document.querySelector(".date");
var now,second,minute,hour,date,month,year;
function showTime(){
    now = new Date();
    second = now.getSeconds()+1;
    minute = now.getMinutes()+1;
    hour = now.getHours()+1;
    date = now.getDate()+1;
    month = now.getMonth()+1;
    year = now.getFullYear();
    clock.innerhtml = '<h1>' + "Melbourne Time:" + year + month + date + hour + minute + second
}

setInterval(showTime,1000)