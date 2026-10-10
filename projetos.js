const track = document.querySelector('.projetos');
const section = document.querySelector('.projetos-secao');
const cards = document.querySelectorAll('.card');

let isDragging = false;
let startX = 0;
let currentTranslate = 0;
let prevTranslate = 0;
let animationId = 0;
let currentIndex = 0;

const itemsPerPage = 3;
const totalItens = cards.length;
const autoPlayDelay = 1000;
let autoPlayTimer = null;

//---Auto plat---
function startAutoPlay(){
    stopAutoPlay();
    autoPlayTimer = setInterval(() => {
    if(currentIndex + itemsPerPage < totalItens){
        currentIndex += itemsPerPage;
    } else{
        currentIndex = 0;
    }
    setPositionByIndex();
}, autoPlayDelay);}

function stopAutoPlay(){
    if (autoPlayTimer) clearInterval(autoPlayTimer);
}

//pausa quando passar por cima do carrossel

section.addEventListener('mouseenter', stopAutoPlay)
section.addEventListener('mouseleave', () =>{
    if(!isDragging) startAutoPlay();
});

//eventos de arraste
track.addEventListener('mousedown', touchStart);
track.addEventListener('mousemove', touchMove);
track.addEventListener('mouseup', touchEnd);
track.addEventListener('mouseleave', touchEnd);

track.addEventListener('touchstart', touchStart);
track.addEventListener('touchmove', touchMove);
track.addEventListener('touchend', touchEnd);

function touchStart(event){
    stopAutoPlay();
    isDragging = true;
    startX = getPositionX(event);
    animationId = requetanimationFrame(animation);
    track.style.transition ='none';
}

function touchMove(event){
    if (!isDragging) return;
    const currentX = getPositionX(event);
    const diff = currentX - startX;
    currentTranslate = prevTranslate + diff;
}

function touchEnd(){
    if (!isDragging) return;
    isDragging = false;
    cancelAnimationFrame(animationId);

    const moveBy = currentTranslate - prevTranslate;


// se arrastou para esquerda o suficiente avança 3 itens
    if (moveBy < -100 && currentIndex + itemsPerPage < totalItens) {
    currentIndex += itemsPerPage;
    }
// se arrastou para direita o suficiente avança 3 itens
    else if (moveBy > 100 && currentIndex + itemsPerPage >= 0) {
        currentIndex -= itemsPerPage;
    }

    setPositionByIndex();
    startAutoPlay();
}