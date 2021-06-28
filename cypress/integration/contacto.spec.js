///<reference types="cypress" />

describe('Prueba el formulario de contacto', () => {
    it('Prueba la pagina de contacto y el envio de emails', () => {
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'formulario Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'formulario Contacto');
    });

    it('Llena los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Antonio')
        cy.get('[data-cy="input-mensaje"]').type('Deseo comprar una casa')
        cy.get('[data-cy="input-opciones"]').select('Vende');
        cy.get('[data-cy="input-precio"]').type('50000')
        cy.get('[data-cy="forma-contacto"]').eq(1).check();

        cy.wait(3000)

        cy.get('[data-cy="forma-contacto"]').eq(0).check();
    });
});