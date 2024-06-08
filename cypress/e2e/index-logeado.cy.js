describe('Index logeado', () => {
    beforeEach(() => {
        cy.visit('http://localhost:8888/Make-Me-A-Pass/');
        cy.login();
    })

    it('Verificar que se muestre el header correctamente', () => {
        cy.get('[data-cy=header]').should('exist').and('be.visible');
        cy.get('[data-cy=header-contrasenyas]').should('exist').and('be.visible');
        cy.get('[data-cy=header-username]').should('exist').and('be.visible');

        cy.get('[data-cy=header-contrasenyas]').should('have.text', 'Contraseñas');
        cy.get('[data-cy=header-username]').should('have.text', 'NavarroBarbas');
    })

    it('Verificar que se muestre el generador de contraseñas correctamente', () => {
        cy.get('[data-cy=generador-settings]').should('exist').and('be.visible');
        cy.get('[data-cy=generador-setting]').should('exist').and('be.visible');
        cy.get('[data-cy=generador-setting]').should('have.length', 4);
        cy.get('[data-cy=generador-length]').should('exist').and('be.visible');

        cy.get('[data-cy=generador-savepass]').should('exist').and('be.visible');
        cy.get('[data-cy=generador-savepass]').should('have.text', 'Guardar Contraseña');
    })
})