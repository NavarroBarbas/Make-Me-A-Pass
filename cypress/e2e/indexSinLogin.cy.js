describe('Test Index Sin Login', () => {

  beforeEach(() => {
    cy.visit('http://localhost:8888/Make-Me-A-Pass/');
    cy.wait(2000);
  });
  it('El generador funciona y se ve correctamente, el Header, Generador, Main y Footer tiene los textos y estilos correctos', () => {
    cy.get('[data-cy=header]').should('exist').and('be.visible');
    cy.get('[data-cy=header-logo]').should('exist').and('be.visible');
    cy.get('[data-cy=header-titulo]').should('exist').and('be.visible');
    cy.get('[data-cy=header-titulo]').should('have.text', 'Make Me A Pass');
    cy.get('[data-cy=header-titulo]').should('have.css', 'color', 'rgb(24, 72, 107)');
    cy.get('[data-cy=header-titulo]').should('have.css', 'font-size', '18px');
    
    cy.get('[data-cy=header-registro]').should('exist');
    cy.get('[data-cy=header-login]').should('exist');
    cy.get('[data-cy=header-registro]').should('have.text', 'Registrarse');
    cy.get('[data-cy=header-login]').should('have.text', 'Iniciar Sesión');
    cy.get('[data-cy=header-registro]').should('have.css', 'color', 'rgb(255, 255, 255)');
    cy.get('[data-cy=header-login]').should('have.css', 'color', 'rgb(0, 38, 66)');
    cy.get('[data-cy=header-registro]').should('have.css', 'font-size', '14px');
    cy.get('[data-cy=header-login]').should('have.css', 'font-size', '14px');

    cy.get('[data-cy=random-password]').should('exist').and('be.visible');
    cy.get('[data-cy=random-password]').should('have.text', 'Click Generar');
    cy.get('[data-cy=btn-generar]').should('exist').and('be.visible');
    cy.get('[data-cy=btn-generar]').click();
    cy.get('[data-cy=btn-copy]').should('exist').and('be.visible');
    cy.get('[data-cy=random-password]').should('not.have.text', 'Click Generar');

    cy.get('[data-cy=info-explicacion-generador').should('exist').and('be.visible');
    cy.get('[data-cy=info-explicacion-generador').should('have.text', '¿Qué es un generador de contraseñas?');
    cy.get('[data-cy=info-explicacion-generador').should('have.css', 'color', 'rgb(44, 44, 44)');
    cy.get('[data-cy=info-explicacion-generador').should('have.css', 'font-size', '24px');

    cy.get('[data-cy=info-buenas-practicas').should('exist').and('be.visible');
    cy.get('[data-cy=info-buenas-practicas').should('have.text', 'Buenas prácticas con las contraseñas');
    cy.get('[data-cy=info-buenas-practicas').should('have.css', 'color', 'rgb(44, 44, 44)');
    cy.get('[data-cy=info-buenas-practicas').should('have.css', 'font-size', '24px');

    cy.get('[data-cy=footer]').scrollIntoView();
    cy.get('[data-cy=footer').should('exist').and('be.visible');
    cy.get('[data-cy=footer]').contains('All Rights Reserved made by Javier Navarro');

    cy.get('[data-cy=footer-links]').should('exist').and('be.visible');
    cy.get('[data-cy=footer-links]').contains('Contacto');
    cy.get('[data-cy=footer-links]').should('have.css', 'color', 'rgb(255, 255, 255)');
    cy.get('[data-cy=footer-links]').should('have.css', 'font-size', '16px');

    cy.get('[data-cy=footer-redes]').should('exist').and('be.visible');
    cy.get('[data-cy=footer-redes]').should('have.text', 'Redes Sociales');
    cy.get('[data-cy=footer-redes]').should('have.css', 'color', 'rgb(255, 255, 255)');
    cy.get('[data-cy=footer-redes]').should('have.css', 'font-size', '18.72px');

  })
})