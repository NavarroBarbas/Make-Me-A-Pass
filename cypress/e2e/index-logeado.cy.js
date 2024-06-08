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

    it('Guardar Contraseña funciona correctamente', () => {
        cy.get('[data-cy=generador-savepass]').click();
        cy.get('[data-cy=form-save-pass-titulo]').should('exist').and('be.visible');
        cy.get('[data-cy=form-save-pass-titulo]').should('have.text', 'Ponga un nombre a la contraseña');
        cy.get('[data-cy=form-save-pass-titulo]').should('have.css', 'color', 'rgb(44, 44, 44)');
        cy.get('[data-cy=form-save-pass-titulo]').should('have.css', 'font-size', '22px');

        cy.get('[data-cy=input-name-save-pass]').should('exist').and('be.visible');
        cy.get('[data-cy=input-name-save-pass]').should('have.attr', 'placeholder', 'Nombre');

        //Nombre de Contraseña es obligatorio
        cy.get('[data-cy=btn-save-pass]').click();
        cy.get('[data-cy=error-save-pass]').should('exist').and('be.visible');
        cy.get('[data-cy=error-save-pass]').should('have.text', 'Nombre es obligatorio');

        //Error al guardar Contraseña sin haber generado una
        cy.get('[data-cy=input-name-save-pass]').type('Password de prueba');
        cy.get('[data-cy=btn-save-pass]').click();
        cy.get('[data-cy=error-save-pass]').should('have.text', 'Debes generar una contraseña');

        //Error al guardar Contraseña por carácteres especiales
        cy.get('body').click(0, 0);
        cy.get('[data-cy=btn-generar]').click();
        cy.get('[data-cy=generador-savepass]').click();
        cy.get('[data-cy=input-name-save-pass]').type('Ñ es inválida');
        cy.get('[data-cy=btn-save-pass]').click();
        cy.get('[data-cy=error-save-pass]').should('have.text', 'El nombre no puede contener carácteres especiales');

        //Contraseña generada y guardada correctamente
        cy.get('body').click(0, 0);
        cy.get('[data-cy=btn-generar]').click();
        cy.get('[data-cy=generador-savepass]').click();
        cy.get('[data-cy=input-name-save-pass]').type('Password de prueba');
        cy.get('[data-cy=btn-save-pass]').click();

        //Comprobar contraseña guardada en Passwords.php
        cy.get('[data-cy=header-contrasenyas]').click();
        cy.get('[data-cy=passwords-buscador]').type('Password de prueba');
        cy.get('[data-cy=passwords-list]').should('exist').and('be.visible');
        cy.get('[data-cy=passwords-list]').should('have.length.greaterThan', 0);
        cy.get('[data-cy=password-nombre]').eq(0).should('have.text', 'Password de prueba');
    })
})