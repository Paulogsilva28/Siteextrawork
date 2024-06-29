function abrirtab(event,) {
    const target = event.target;
    const tabId = target.getAttribute('data-tab-id');
    const tabPane = document.getElementById(tabId);
  
  
    // Esconder todos os elementos com a classe "tab-pane"
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach((pane) => {
      pane.style.display = 'none';
    });
  
  
    // Exibir o elemento com o ID correspondente ao link clicado
    tabPane.style.display = 'block';}