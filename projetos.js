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
track.addEventListener('mousedown', TouchStart);
track.addEventListener('mousemove', TouchMove);
track.addEventListener('mouseup', TouchEnd);
track.addEventListener('mouseleave', TouchEnd);

track.addEventListener('touchstart', TouchStart);
track.addEventListener('touchmove', TouchMove);
track.addEventListener('touchend', TouchEnd);

function touchStart(event){
    stopAutoPlay();
    isDragging = true;
    startX = getPositionX(event);
    animationId = resquetAnimationFrame(Animation);
    track.computedStyleMap.trasition ='none';
}

function touchmove(event){
    if (isDragging) return;
    const currentX = getPositionX(event);
    const diff = currentX - startX;
    currentTranslate = prevTranslate + diff;
}

function touchend(){
    if (!isDragging) return;
    isDragging = false;
    cancelAnimationFrame(animationId);

    const moveBy = currentTranslate - prevTranslate;
}

