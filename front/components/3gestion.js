const Gestion = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
      <section class="flex flex-col justify-center px-16 py-20 w-full bg-white max-md:px-5 max-md:max-w-full">
        <div class="mt-8 mb-2.5 max-md:mr-1 max-md:max-w-full">
          <div class="flex gap-5 max-md:flex-col max-md:gap-0">
            <div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
              <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="grow w-full aspect-[0.96] max-md:mt-10 max-md:max-w-full" />
            </div>
            <div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
              <div class="flex flex-col self-stretch my-auto text-black max-md:mt-10 max-md:max-w-full">
                <div class="flex flex-col justify-center py-6 pl-8 border-l-2 border-solid border-l-black max-md:pl-5 max-md:max-w-full">
                  <h3 class="text-3xl font-bold leading-10 max-md:max-w-full">Gestion des annonces</h3>
                  <p class="mt-4 text-base leading-6 max-md:max-w-full">Créez, gérez et publiez facilement des annonces pour vos propriétés.</p>
                </div>
                <div class="flex flex-col justify-center py-6 pl-8 mt-10 max-md:pl-5 max-md:max-w-full">
                  <h3 class="text-3xl font-bold leading-10 max-md:max-w-full">Gestion des réservations</h3>
                  <p class="mt-4 text-base leading-6 max-md:max-w-full">Visualisez et gérez toutes vos réservations en un seul endroit.</p>
                </div>
                <div class="flex flex-col justify-center py-6 pl-8 mt-10 max-md:pl-5 max-md:max-w-full">
                  <h3 class="text-3xl font-bold leading-10 max-md:max-w-full">Gestion financière</h3>
                  <p class="mt-4 text-base leading-6 max-md:max-w-full">Obtenez une vue d'ensemble en temps réel de vos finances et de vos revenus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </template>
  </nav>
  `,
};