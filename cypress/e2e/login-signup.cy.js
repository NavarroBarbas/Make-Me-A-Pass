describe("Modal Registro de Usuario", () => {
    beforeEach(() => {
        cy.visit("http://localhost:8888/Make-Me-A-Pass/");
        cy.wait(2000);
    });

    it("El Modal de Registro se abre y cierra correctamente y tiene los textos y estilos correspondientes", () => {
        cy.get("[data-cy=header-registro]").click();
        cy.get("[data-cy=modal-registro]").should("exist").and("be.visible");

        cy.get("[data-cy=modal-logo]").eq(1).should("exist").and("be.visible");
        cy.get("[data-cy=modal-titulo-web]").eq(1).should("exist").and("be.visible");
        cy.get("[data-cy=modal-titulo-web]").eq(1).contains("Make Me A Pass");

        cy.get("[data-cy=form-titulo-registro]").should("exist").and("be.visible");
        cy.get("[data-cy=form-titulo-registro]").should("have.text", "Regístrate");
        cy.get("[data-cy=form-titulo-registro]").should("have.css", "color","rgb(44, 44, 44)");
        cy.get("[data-cy=form-titulo-registro]").should("have.css", "font-size", "22px");

        cy.get("[data-cy=input-email-registro]").should("exist").and("be.visible");
        cy.get("[data-cy=input-email-registro]").should("have.attr", "placeholder", "Email");

        cy.get("[data-cy=input-pass-registro]").should("exist").and("be.visible");
        cy.get("[data-cy=input-pass-registro]").should("have.attr", "placeholder", "Contraseña");

        cy.get("[data-cy=input-passvfy-registro]").should("exist").and("be.visible");
        cy.get("[data-cy=input-passvfy-registro]").should("have.attr", "placeholder", "Confirmar Contraseña");

        cy.get("[data-cy=btn-submit-registro]").should("exist").and("be.visible");
        cy.get("[data-cy=btn-submit-registro]").should("have.attr", "value", "Enviar");
        
        cy.get("[data-cy=modal-registro]").should("exist").and("be.visible");
        cy.get("body").click(0, 0);
        cy.get("[data-cy=modal-registro]").should("exist").and("not.be.visible");
    })

    it("El Modal de Registro funciona correctamente con los datos correctos", () => {
        cy.get("[data-cy=header-registro]").click();

        cy.get("[data-cy=input-email-registro]").type("lmax3r@hotmail.com");

        cy.get("[data-cy=input-pass-registro]").type("12345678");

        cy.get("[data-cy=input-passvfy-registro]").type("12345678");

        cy.intercept("POST", "**/php/registrarse.php").as("registro");
        cy.get("[data-cy=btn-submit-registro]").click();

        cy.wait("@registro");
        cy.get('[data-cy=passvfy-error-registro').should('have.text', 'Revise su email para confirmar su cuenta');
        cy.get("[data-cy=passvfy-error-registro]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=passvfy-error-registro').should('have.css', 'font-size', '12px');
    });

    it("El Modal de Registro funciona correctamente sin datos en los inputs", () => {

        cy.get("[data-cy=header-registro]").click();

        cy.get("[data-cy=btn-submit-registro]").click();

        cy.get('[data-cy=email-error-registro').should('have.text', 'Email es obligatorio');
        cy.get("[data-cy=email-error-registro]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=email-error-registro').should('have.css', 'font-size', '12px');

        cy.get('[data-cy=pass-error-registro').should('have.text', 'Contraseña es obligatoria');
        cy.get("[data-cy=pass-error-registro]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=pass-error-registro').should('have.css', 'font-size', '12px');

        cy.get('[data-cy=passvfy-error-registro').should('have.text', 'Confirmar contraseña es obligatorio');
        cy.get("[data-cy=passvfy-error-registro]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=passvfy-error-registro').should('have.css', 'font-size', '12px');
    })
    
    it("El Modal de Registro funciona correctamente con email inválido", () => {
        cy.get("[data-cy=header-registro]").click();
        cy.get('[data-cy=input-email-registro').type("lmax3rhotmail.com");


        cy.get("[data-cy=btn-submit-registro]").click();
        cy.get('[data-cy=email-error-registro]').should('have.text', 'Email es incorrecto');
    })

    it("El Modal de Registro funciona correctamente con contraseñas inválidas", () => {
        cy.get("[data-cy=header-registro]").click();
        cy.get('[data-cy=input-pass-registro').type("123456");


        cy.get("[data-cy=btn-submit-registro]").click();
        cy.get('[data-cy=pass-error-registro]').should('have.text', 'Contraseña debe tener mínimo 8 carácteres');
        cy.get('[data-cy=passvfy-error-registro]').should('have.text', 'Las contraseñas deben coincidir');
    })
});

describe("Modal Login de Usuario", () => {
    beforeEach(() => {
        cy.visit("http://localhost:8888/Make-Me-A-Pass/");
        cy.wait(2000);
    });

    it("El Modal de Login se abre y cierra correctamente y tiene los textos y estilos correspondientes", () => {
        cy.get("[data-cy=header-login]").click();
        cy.get("[data-cy=modal-login]").should("exist").and("be.visible");

        cy.get("[data-cy=modal-logo]").eq(0).should("exist").and("be.visible");
        cy.get("[data-cy=modal-titulo-web]").eq(0).should("exist").and("be.visible");
        cy.get("[data-cy=modal-titulo-web]").eq(0).contains("Make Me A Pass");

        cy.get("[data-cy=form-titulo-login]").should("exist").and("be.visible");
        cy.get("[data-cy=form-titulo-login]").should("have.text", "Iniciar Sesión");
        cy.get("[data-cy=form-titulo-login]").should("have.css", "color","rgb(44, 44, 44)");
        cy.get("[data-cy=form-titulo-login]").should("have.css", "font-size", "22px");

        cy.get("[data-cy=input-email-login]").should("exist").and("be.visible");
        cy.get("[data-cy=input-email-login]").should("have.attr", "placeholder", "Email");

        cy.get("[data-cy=input-pass-login]").should("exist").and("be.visible");
        cy.get("[data-cy=input-pass-login]").should("have.attr", "placeholder", "Contraseña");

        cy.get("[data-cy=form-reset-pass-login]").should("exist").and("be.visible");
        cy.get("[data-cy=form-reset-pass-login]").contains("¿Has olvidado tu contraseña?");
        cy.get("[data-cy=form-reset-pass-login]").should("have.css", "color","rgb(44, 44, 44)");
        cy.get("[data-cy=form-reset-pass-login]").should("have.css", "font-size", "14px");

        cy.get("[data-cy=btn-submit-login]").should("exist").and("be.visible");
        cy.get("[data-cy=btn-submit-login]").should("have.attr", "value", "Enviar");
        
        cy.get("[data-cy=modal-login]").should("exist").and("be.visible");
        cy.get("body").click(0, 0);
        cy.get("[data-cy=modal-login]").should("exist").and("not.be.visible");
    })

    it("El Modal de Login funciona correctamente con los datos correctos", () => {
        cy.get("[data-cy=header-login]").click();

        cy.get("[data-cy=input-email-login]").type("lmax3r@hotmail.com");

        cy.get("[data-cy=input-pass-login]").type("12345678");

        cy.intercept("POST", "**/php/login.php").as("login");
        cy.get("[data-cy=btn-submit-login]").click();

        cy.wait("@login");
        cy.get('[data-cy=pass-error-login').should('have.text', 'Datos de usuario incorrectos o sin confirmar');
        cy.get("[data-cy=pass-error-login]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=pass-error-login').should('have.css', 'font-size', '12px');
    })

    it("El Modal de Login funciona correctamente sin datos en los inputs", () => {

        cy.get("[data-cy=header-login]").click();

        cy.get("[data-cy=btn-submit-login]").click();

        cy.get('[data-cy=email-error-login').should('have.text', 'Email es obligatorio');
        cy.get("[data-cy=email-error-login]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=email-error-login').should('have.css', 'font-size', '12px');

        cy.get('[data-cy=pass-error-login').should('have.text', 'Contraseña es obligatoria');
        cy.get("[data-cy=pass-error-login]").should("have.css", "color", "rgb(255, 0, 0)");
        cy.get('[data-cy=pass-error-login').should('have.css', 'font-size', '12px');
    })

    it("El Modal de Login funciona correctamente con email inválido", () => {
        cy.get("[data-cy=header-login]").click();
        cy.get('[data-cy=input-email-login').type("lmax3rhotmail.com");


        cy.get("[data-cy=btn-submit-login]").click();
        cy.get('[data-cy=email-error-login]').should('have.text', 'Email es incorrecto');
    })

    it("El Modal de Login cambia correctamente a Modal de Reset Pass", () => {
        cy.get("[data-cy=header-login]").click();
        cy.get("[data-cy=form-reset-pass-login]").click();

        cy.get("[data-cy=modal-login]").should("exist").and("not.be.visible");
        cy.get("[data-cy=modal-reset-pass]").should("exist").and("be.visible");

        cy.get("[data-cy=modal-logo]").eq(2).should("exist").and("be.visible");
        cy.get("[data-cy=modal-titulo-web]").eq(2).should("exist").and("be.visible");

        cy.get("[data-cy=form-titulo-reset-pass]").should("exist").and("be.visible");
        cy.get("[data-cy=form-titulo-reset-pass]").should("have.text", "¿Olvidaste tu Contraseña?");
        cy.get("[data-cy=form-titulo-reset-pass]").should("have.css", "color","rgb(44, 44, 44)");
        cy.get("[data-cy=form-titulo-reset-pass]").should("have.css", "font-size", "22px");

        cy.get("[data-cy=input-email-reset-pass]").should("exist").and("be.visible");
        cy.get("[data-cy=input-email-reset-pass]").should("have.attr", "placeholder", "Email");

        cy.get("[data-cy=btn-submit-reset-pass]").should("exist").and("be.visible");
        cy.get("[data-cy=btn-submit-reset-pass]").should("have.attr", "value", "Enviar");

        cy.get("body").click(0, 0);
        cy.get("[data-cy=modal-reset-pass]").should("exist").and("not.be.visible");
    })

    it("El Modal de Reset Pass funciona correctamente con email correcto", () => {
        cy.get("[data-cy=header-login]").click();
        cy.get("[data-cy=form-reset-pass-login]").click();

        cy.get("[data-cy=input-email-reset-pass]").type("javier@hotmail.com");
        cy.intercept("POST", "**/php/resetpass.php").as("resetpass");
        cy.get("[data-cy=btn-submit-reset-pass]").click();
        cy.wait("@resetpass");
        cy.get('[data-cy=email-error-reset-pass').should('have.text', 'Revise su email para restablecer su contraseña.Si no existe no se enviará nada.');
    })

    it("El Modal de Reset Pass funciona correctamente sin email", () => {
        cy.get("[data-cy=header-login]").click();
        cy.get("[data-cy=form-reset-pass-login]").click();

        cy.get("[data-cy=btn-submit-reset-pass]").click();
        cy.get('[data-cy=email-error-reset-pass').should('have.text', 'Email es obligatorio');
    })

    it("El Modal de Reset Pass funciona correctamente con email inválido", () => {
        cy.get("[data-cy=header-login]").click();
        cy.get("[data-cy=form-reset-pass-login]").click();
        cy.get("[data-cy=input-email-reset-pass]").type("javierhotmail.com");

        cy.get("[data-cy=btn-submit-reset-pass]").click();
        cy.get('[data-cy=email-error-reset-pass]').should('have.text', 'Email es incorrecto');
    })
});
