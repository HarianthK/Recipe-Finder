let text = document.querySelector('.animate-text');

const strText = text.textContent;


const splitText = strText.split("");

// console.log(strText);
// console.log(splitText);

text.textContent = "";

for(let i = 0 ; i < splitText.length ; i++)
{

    text.innerHTML += `<span>${splitText[i]}</span>`
}


let char = 0;

let timer = setInterval(onTick , 50);

function onTick()
{
    const span = text.querySelectorAll('span')[char];
    span.classList.add('fade');
    char = char + 1;
    if(char ===  splitText.length)
    {
        complete();
        return;
    }
}



function complete()
{
    text.classList.add('something');
    console.log(text.classList);
    clearInterval(timer);

    timer = null;
    window.setTimeout(()=>{window.location="http://localhost/miniprojecgt/forms/Main%20Page/";},1000);
}