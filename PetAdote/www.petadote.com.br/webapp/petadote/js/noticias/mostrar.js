function mostrar(e){

  if (e.firstChild.nodeValue != 'Mostrar Menos') {
    e.parentNode.previousElementSibling.previousElementSibling.style.maxHeight = 'none';
    e.parentNode.previousElementSibling.previousElementSibling.style.height = 'auto';
    e.style.backgroundColor = '#B7342E';
    e.firstChild.nodeValue = 'Mostrar Menos';

  } else {
    e.parentNode.previousElementSibling.previousElementSibling.style.maxHeight = '200px';
    e.parentNode.previousElementSibling.previousElementSibling.style.overflow = 'hidden';
    e.style.backgroundColor = '#0089AD';
    e.firstChild.nodeValue = 'Mostrar Mais';
  }

}
