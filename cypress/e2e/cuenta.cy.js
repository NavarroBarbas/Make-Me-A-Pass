describe('Cuenta de Usuario', () => {
    beforeEach(() => {
        cy.visit('http://makemeapass.javiernavarroedib.com/');
        cy.get('[data-cy=modal-anuncio-close]').click(0, 0);
        cy.login();
        cy.get('[data-cy=header-username]').click();
        cy.url().should('include', '/cuenta.php');
    });
    
    it('La barra lateral del menú usuario debe tener los estilos y textos correctos', () => {
        cy.get('[data-cy=cuenta-barra-opciones]').should('exist').and('be.visible');
        cy.get('[data-cy=barra-opciones]').should('exist').and('be.visible');

        cy.get('[data-cy=barra-email]').should('exist').and('be.visible');
        cy.get('[data-cy=barra-email]').should('have.text', 'javier@hotmail.com');
        cy.get('[data-cy=barra-email]').should('have.css', 'color', 'rgb(44, 44, 44)');
        cy.get('[data-cy=barra-email]').should('have.css', 'font-weight', '400');

        cy.get('[data-cy=btn-cambio-usuario]').should('exist').and('be.visible')
        cy.get('[data-cy=btn-cambio-usuario]').contains('Nombre de Usuario');
        cy.get('[data-cy=btn-cambio-usuario]').should('have.css', 'color', 'rgb(245, 245, 245)');
        cy.get('[data-cy=btn-cambio-usuario]').should('have.css', 'border-radius', '15px');
        cy.get('[data-cy=btn-cambio-usuario]').should('have.css', 'background', 'rgba(0, 0, 0, 0) linear-gradient(90deg, rgb(0, 115, 199) 0%, rgb(61, 146, 220) 100%) repeat scroll 0% 0% / auto padding-box border-box');

        cy.get('[data-cy=btn-cambio-contrasenya]').should('have.css', 'background', 'rgba(0, 0, 0, 0) none repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=btn-eliminar-usuario]').should('have.css', 'background', 'rgba(0, 0, 0, 0) none repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=btn-cerrar-sesion]').should('have.css', 'background', 'rgb(44, 44, 44) none repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=btn-cerrar-sesion]').should('have.css', 'color', 'rgb(255, 255, 255)');
        cy.get('[data-cy=btn-cerrar-sesion]').should('have.css', 'border-radius', '10px');
    })

    it('El formulario de cambio de usuario tiene los textos y estilos correctos sin datos o con datos incorrectos', () => {
        cy.get('[data-cy=btn-submit-cambio-usuario]').click();

        //Nombre de usuario y contraseña vacíos
        cy.get('[data-cy=error-username-cambio-usuario]').should('exist').and('be.visible');
        cy.get('[data-cy=error-username-cambio-usuario]').contains('El nombre de Usuario es obligatorio');
        cy.get('[data-cy=error-username-cambio-usuario]').should('have.css', 'color', 'rgb(255, 0, 0)');
        cy.get('[data-cy=error-username-cambio-usuario]').should('have.css', 'font-size', '12px');

        cy.get('[data-cy=error-pass-cambio-usuario]').contains('La antigua contraseña es obligatoria');
        cy.get('[data-cy=error-pass-cambio-usuario]').should('have.css', 'color', 'rgb(255, 0, 0)');
        cy.get('[data-cy=error-pass-cambio-usuario]').should('have.css', 'font-size', '12px');

        //Nombre de usuario demasiado corto
        cy.get('[data-cy=input-username-cambio-usuario]').type("AAA");
        cy.get('[data-cy=btn-submit-cambio-usuario]').click();
        cy.get('[data-cy=error-username-cambio-usuario]').contains('El nombre de Usuario no puede tener menos de 6 carácteres');

        //Nombre de usuario demasiado largo
        cy.get('[data-cy=input-username-cambio-usuario]').clear();
        cy.get('[data-cy=input-username-cambio-usuario]').type("QWERTYUIOPASDFGHJKLÑ");
        cy.get('[data-cy=btn-submit-cambio-usuario]').click();
        cy.get('[data-cy=error-username-cambio-usuario]').contains('El nombre de Usuario no puede tener más de 16 carácteres');

        //Contraseña incorrecta
        cy.get('[data-cy=input-username-cambio-usuario]').clear();
        cy.get('[data-cy=input-username-cambio-usuario]').type("NavarroBarbas");
        cy.get('[data-cy=input-pass-cambio-usuario]').type("1234567");
        cy.get('[data-cy=btn-submit-cambio-usuario]').click();
        cy.get('[data-cy=error-pass-cambio-usuario]').contains('Contraseña incorrecta');
    })

    it('El formulario de cambio de contraseña tiene los textos y estilos correctos sin datos o con datos incorrectos', () => {
        cy.get('[data-cy=btn-cambio-contrasenya]').click();

        //Contraseña nueva y antigua vacías
        cy.get('[data-cy=btn-submit-cambio-password]').click();
        cy.get('[data-cy=error-newpass-cambio-password]').contains('Contraseña es obligatoria');
        cy.get('[data-cy=error-confirmar-cambio-password]').contains('Confirmar contraseña es obligatorio');
        cy.get('[data-cy=error-oldpass-cambio-password]').contains('La antigua contraseña es obligatoria');

        //Contraseña nueva y antigua diferentes
        cy.get('[data-cy=input-newpass-cambio-password]').type("12345678");
        cy.get('[data-cy=input-confirmar-cambio-password]').type("12345679");
        cy.get('[data-cy=btn-submit-cambio-password]').click();
        cy.get('[data-cy=error-confirmar-cambio-password]').contains('Las contraseñas deben coincidir');

        //Contraseña nueva demasiado corta
        cy.get('[data-cy=input-newpass-cambio-password]').clear();
        cy.get('[data-cy=input-newpass-cambio-password]').type("123");
        cy.get('[data-cy=btn-submit-cambio-password]').click();
        cy.get('[data-cy=error-newpass-cambio-password]').contains('Contraseña debe tener mínimo 8 carácteres');

        //Contraseña antigua incorrecta
        cy.get('[data-cy=input-newpass-cambio-password]').clear();
        cy.get('[data-cy=input-newpass-cambio-password]').type("12345678");
        cy.get('[data-cy=input-confirmar-cambio-password]').clear();
        cy.get('[data-cy=input-confirmar-cambio-password]').type("12345678");
        cy.get('[data-cy=input-oldpass-cambio-password]').type("1234567");
        cy.get('[data-cy=btn-submit-cambio-password]').click();
        cy.get('[data-cy=error-oldpass-cambio-password]').contains('Contraseña incorrecta');
    })

    it('Debe mostrar el formulario de cambio de contraseña y funcionar correctamente. Cerrar Sesión y volver a entrar con la nueva contraseña', () => {
        const newPass = "12121212";
        const oldPass = "12345678";

        cy.get('[data-cy=btn-cambio-contrasenya]').click();
        cy.get('[data-cy=btn-cambio-contrasenya]').should('have.css', 'background', 'rgba(0, 0, 0, 0) linear-gradient(90deg, rgb(0, 115, 199) 0%, rgb(61, 146, 220) 100%) repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=btn-cambio-usuario]').should('have.css', 'background', 'rgba(0, 0, 0, 0) none repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=form-cambio-usuario]').should('not.be.visible');
        cy.get('[data-cy=form-cambio-password]').should('exist').and('be.visible');

        cy.get('[data-cy=input-newpass-cambio-password]').should('exist').and('be.visible');
        cy.get('[data-cy=input-newpass-cambio-password]').should('have.attr', 'placeholder', 'Nueva Contraseña');
        cy.get('[data-cy=input-newpass-cambio-password]').type(newPass);

        cy.get('[data-cy=input-confirmar-cambio-password]').should('exist').and('be.visible');
        cy.get('[data-cy=input-confirmar-cambio-password]').should('have.attr', 'placeholder', 'Confirmar Contraseña');
        cy.get('[data-cy=input-confirmar-cambio-password]').type(newPass);

        cy.get('[data-cy=input-oldpass-cambio-password]').should('exist').and('be.visible');
        cy.get('[data-cy=input-oldpass-cambio-password]').should('have.attr', 'placeholder', 'Contraseña Antigua');
        cy.get('[data-cy=input-oldpass-cambio-password]').type(oldPass);

        cy.get('[data-cy=btn-submit-cambio-password]').should('exist').and('be.visible');
        cy.get('[data-cy=btn-submit-cambio-password]').should('have.attr', 'value', 'Enviar');
        cy.get('[data-cy=btn-submit-cambio-password]').should('have.css', 'background', 'rgb(0, 115, 199) none repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=btn-submit-cambio-password]').should('have.css', 'color', 'rgb(255, 255, 255)');
        cy.get('[data-cy=btn-submit-cambio-password]').should('have.css', 'border-radius', '15px');
        cy.get('[data-cy=btn-submit-cambio-password]').click();
        cy.wait(1500);

        cy.get('[data-cy=btn-cerrar-sesion]').click();
        cy.url().should('include', 'http://makemeapass.javiernavarroedib.com/');

        cy.get('[data-cy=header-login]').click();
        cy.get('[data-cy=input-email-login]').type('javier@hotmail.com');
        cy.get('[data-cy=input-pass-login]').type(newPass);
        cy.get('[data-cy=btn-submit-login]').click();
        cy.get('[data-cy=header-username]').should('have.text', 'NavarroBarbas');

        cy.get('[data-cy=header-username]').click();
        cy.get('[data-cy=btn-cambio-contrasenya]').click();
        cy.get('[data-cy=input-newpass-cambio-password]').type(oldPass);
        cy.get('[data-cy=input-confirmar-cambio-password]').type(oldPass);
        cy.get('[data-cy=input-oldpass-cambio-password]').type(newPass);
        cy.get('[data-cy=btn-submit-cambio-password]').click();
    })

    it('Debe mostrar el formulario de cambio de nombre de usuario y funcionar correctamente', () => {
        const newUsername = "Navarro";

        cy.get('[data-cy=form-cambio-usuario]').should('exist').and('be.visible');
        cy.get('[data-cy=form-cambio-password]').should('exist').and('not.be.visible');

        cy.get('[data-cy=input-username-cambio-usuario]').should('exist').and('be.visible');
        cy.get('[data-cy=input-username-cambio-usuario]').should('have.attr', 'placeholder', 'Nombre de Usuario');
        cy.get('[data-cy=input-username-cambio-usuario]').type(newUsername);

        cy.get('[data-cy=input-pass-cambio-usuario]').should('exist').and('be.visible');
        cy.get('[data-cy=input-pass-cambio-usuario]').should('have.attr', 'placeholder', 'Contraseña');
        cy.get('[data-cy=input-pass-cambio-usuario]').type('12345678');

        cy.get('[data-cy=btn-submit-cambio-usuario]').should('exist').and('be.visible');
        cy.get('[data-cy=btn-submit-cambio-usuario]').should('have.attr', 'value', 'Enviar');
        cy.get('[data-cy=btn-submit-cambio-usuario]').should('have.css', 'background', 'rgb(0, 115, 199) none repeat scroll 0% 0% / auto padding-box border-box');
        cy.get('[data-cy=btn-submit-cambio-usuario]').should('have.css', 'color', 'rgb(255, 255, 255)');
        cy.get('[data-cy=btn-submit-cambio-usuario]').should('have.css', 'border-radius', '15px');
        cy.get('[data-cy=btn-submit-cambio-usuario]').click();

        cy.get('[data-cy=header-username]').should('have.text', newUsername);
        cy.wait(2000);
    })

    after(() => {
        cy.get('[data-cy=input-username-cambio-usuario]').clear();
        cy.get('[data-cy=input-username-cambio-usuario]').type("NavarroBarbas");
        cy.get('[data-cy=input-pass-cambio-usuario]').clear();
        cy.get('[data-cy=input-pass-cambio-usuario]').type('12345678');
        cy.get('[data-cy=btn-submit-cambio-usuario]').click();
    })

});