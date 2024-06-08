describe('Página Passwords', () => {
    beforeEach(() => {
        cy.visit('http://localhost:8888/Make-Me-A-Pass/');
        cy.login();
        cy.get('[data-cy=header-contrasenyas]').click();
        cy.url().should('include', '/passwords');
    })

    it('La página de Passwords funciona correctamente y tiene los estilos correctos', () => {
        cy.get('[data-cy=passwords-titulo').should('exist').and('be.visible');
        cy.get('[data-cy=passwords-titulo').contains('Contraseñas');

        cy.get('[data-cy=passwords-newpass').should('exist').and('be.visible');
        cy.get('[data-cy=passwords-buscador]').should('exist').and('be.visible');
        cy.get('[data-cy=passwords-buscador]').should('have.attr', 'placeholder', 'Buscar...');

        //Add new pass
        cy.get('[data-cy=passwords-newpass').click();
        cy.get('[data-cy=form-newpass-titulo]').should('exist').and('be.visible');
        cy.get('[data-cy=form-newpass-titulo]').should('have.text', 'Añada una Contraseña');

        cy.get('[data-cy=form-newpass-nombre]').type('AAPrueba');
        cy.get('[data-cy=form-newpass-password]').type('PruebaPassword');

        cy.intercept('POST', '**/php/guardarpass.php').as('guardarpass');
        cy.get('[data-cy=btn-submit-newpass]').click();
        cy.wait('@guardarpass');

        //List Passwords
        cy.get('[data-cy=passwords-list]').should('exist').and('be.visible');
        cy.get('[data-cy=list-password]').should('exist').and('be.visible');
        cy.get('[data-cy=password-nombre]').should('exist').and('be.visible');
        cy.get('[data-cy=password-nombre]').eq(0).contains('AAPrueba');
        cy.get('[data-cy=password-nombre]').should('have.css', 'color', 'rgb(44, 44, 44)');
        cy.get('[data-cy=password-nombre]').should('have.css', 'font-size', '16px');
        cy.get('[data-cy=password-nombre]').should('have.css', 'font-weight', '700');

        cy.get('[data-cy=password-pass]').should('exist').and('be.visible');
        cy.get('[data-cy=password-pass]').eq(0).contains('PruebaPassword');
        cy.get('[data-cy=password-pass]').should('have.css', 'color', 'rgb(44, 44, 44)');
        cy.get('[data-cy=password-pass]').should('have.css', 'font-size', '14px');
        cy.get('[data-cy=password-pass]').should('have.css', 'font-weight', '400');

        cy.get('[data-cy=password-footer]').should('exist').and('be.visible');
        cy.get('[data-cy=password-footer]').should('have.css', 'background', 'rgba(0, 0, 0, 0) linear-gradient(265deg, rgb(61, 146, 220), rgb(0, 115, 199)) repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=password-eliminar]').should('exist').and('be.visible');
        cy.get('[data-cy=password-eliminar]').eq(0).should('have.text', 'Eliminar');
        cy.get('[data-cy=password-eliminar]').should('have.css', 'color', 'rgb(255, 255, 255)');
        cy.get('[data-cy=password-eliminar]').should('have.css', 'font-size', '12px');
        cy.get('[data-cy=password-copiar]').should('exist').and('be.visible');
        cy.get('[data-cy=password-copiar]').eq(0).should('have.text', 'Copiar');
        cy.get('[data-cy=password-copiar]').should('have.css', 'color', 'rgb(255, 255, 255)');
        cy.get('[data-cy=password-copiar]').should('have.css', 'font-size', '12px');

        //Buscar Password
        cy.get('[data-cy=passwords-buscador]').type('AAPrueba');
        cy.get('[data-cy=list-password]').should('have.length.greaterThan', 0);

        //Copiar Password
        cy.get('[data-cy=password-copiar]').should('exist').and('be.visible');
        cy.get('[data-cy=password-copiar]').eq(0).click();

        //Eliminar Password
        cy.intercept('POST', '**/php/deletepass.php').as('eliminarpass');
        cy.get('[data-cy=password-eliminar]').eq(0).click();
        cy.wait('@eliminarpass');
        cy.get('[data-cy=list-password]').filter(':contains("AAPrueba")').should('not.exist');
    })
})