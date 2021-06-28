///<reference types="cypress" />

describe('Prueba la navegacion y Routing del header y footer', () => {
    it('Puerba la navegacion del header', () => {
        cy.visit('/');

        cy.get('[data-cy="navegacion-header"]').should('exist');
        cy.get('[data-cy="navegacion-header"]').find('a').should('have.length', 4);
        cy.get('[data-cy="navegacion-header"]').find('a').should('not.have.length', 5);

        //revisar que los enlaces sean correctos
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/nosotros');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/propiedades');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('text').should('equal', 'Anuncios');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/blog');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('text').should('equal', 'Blog');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/contacto');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');


    });

    it('Puerba la navegacion del footer', () => {
        //revisar que los enlaces sean correctos
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/nosotros');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/propiedades');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('text').should('equal', 'Anuncios');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/blog');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('text').should('equal', 'Blog');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/contacto');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');

        cy.get('[data-cy="copyright"]').should('have.prop', 'class').should('equal', 'copyright');

    });
});