const track = document.querySelector('.projetos');
const section = document.querySelector('.projetos-secao');
const cards = document.querySelectorAll('.cards');

let isDragging = false;
let startX = 0;
let currentTranslate = 0;
let prevtranslate = 0;
let animationId = 0;
let currentIndex = 0;

const itemsPerPage = 3;
const totalItens = cards.length;
const autoPlayDelay = 3500;
let autoPlayTimer = null;

//---Auto plat---
function startAutoPlay(){
    stopAutoPlay();
    autoPlayTimer = setInterval(() => {
    if(courrentIndex + itemsPerPage < totalItens{
        currentIndex +=itemsPerPage;
    } else{
        currentIndex = 0;
    }
    setPositionByIndex();
}, autoPlayDelay);}

function startAutoPlay(){
    if (autoPlayTimer) clearInterval(autoPlayTimer);
}

