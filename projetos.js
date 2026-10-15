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
const autoPlayDelay = 3000; // Aumentado para 3 segundos (1s é muito rápido para autoplay)
let autoPlayTimer = null;

// --- Auto Play ---
function startAutoPlay() {
    stopAutoPlay();
    autoPlayTimer = setInterval(() => {
        if (currentIndex + itemsPerPage < totalItens) {
            currentIndex += itemsPerPage;
        } else {
            currentIndex = 0;
        }
        setPositionByIndex();
    }, autoPlayDelay);
}

function stopAutoPlay() {
    if (autoPlayTimer) clearInterval(autoPlayTimer);
}

// Pausa no hover
section.addEventListener('mouseenter', stopAutoPlay);
section.addEventListener('mouseleave', () => {
    if (!isDragging) startAutoPlay();
});

// Eventos de arraste
track.addEventListener('mousedown', touchStart);
track.addEventListener('mousemove', touchMove);
track.addEventListener('mouseup', touchEnd);
track.addEventListener('mouseleave', touchEnd);

track.addEventListener('touchstart', touchStart);
track.addEventListener('touchmove', touchMove);
track.addEventListener('touchend', touchEnd);

function touchStart(event) {
    stopAutoPlay();
    isDragging = true;
    startX = getPositionX(event);
    animationId = requestAnimationFrame(animation);
    track.style.transition = 'none';
}

function touchMove(event) {
    if (!isDragging) return;
    const currentX = getPositionX(event);
    const diff = currentX - startX;
    currentTranslate = prevTranslate + diff;
}

function touchEnd() {
    if (!isDragging) return;
    isDragging = false;
    cancelAnimationFrame(animationId);

    const moveBy = currentTranslate - prevTranslate;

    // Se arrastou para a esquerda o suficiente, avança 3 itens
    if (moveBy < -100 && currentIndex + itemsPerPage < totalItens) {
        currentIndex += itemsPerPage;
    }
    // Se arrastou para a direita o suficiente, recua 3 itens
    else if (moveBy > 100 && currentIndex - itemsPerPage >= 0) {
        currentIndex -= itemsPerPage;
    }

    setPositionByIndex();
    startAutoPlay();
}

function getPositionX(event) {
    return event.type.includes('mouse') ? event.clientX : event.touches[0].clientX;
}

function animation() {
    setSliderPosition();
    if (isDragging) requestAnimationFrame(animation);
}

function setSliderPosition() {
    track.style.transform = `translateX(${currentTranslate}px)`;
}


function setPositionByIndex() {
    if (cards.length === 0) return;
    
    // Obtém o elemento que contém os cards e a sua largura interna
    const container = document.querySelector('.carrossel-mask') || section;
    const containerWidth = container.getBoundingClientRect().width;
    
    // Calcula a largura exata de 1 card + o seu gap relativo
    // (A translação exata para saltar 3 cards é a própria largura total visível do container)
    const pageShift = containerWidth;
    
    // Calcula o índice do bloco de 3 em 3 (0 para os cards 1-3, 1 para os cards 4-6)
    const pageIndex = currentIndex / itemsPerPage;
    
    currentTranslate = -pageIndex * pageShift;
    prevTranslate = currentTranslate;
    
    track.style.transition = 'transform 0.4s ease-out';
    setSliderPosition();
}


// Iniciar o carrossel
startAutoPlay();