const Contact = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
        <main class="flex flex-col px-16 py-20 w-full bg-white max-md:px-5 max-md:max-w-full">
          <section class="flex flex-col mt-8 max-w-full text-black w-[768px]">
            <h1 class="text-base font-semibold leading-6 text-center max-md:max-w-full">Réservez</h1>
            <div class="flex flex-col mt-4 max-md:max-w-full">
              <h2 class="text-5xl font-bold leading-[57.6px] max-md:max-w-full max-md:text-4xl">Contactez-nous</h2>
              <p class="mt-6 text-lg leading-7 max-md:max-w-full">
                Besoin d'aide ou d'informations supplémentaires ? N'hésitez pas à nous contacter.
              </p>
            </div>
          </section>
          <section class="mt-20 mb-2.5 max-md:mt-10 max-md:max-w-full">
            <div class="flex gap-5 max-md:flex-col max-md:gap-0">
              <div class="flex flex-col w-[32%] max-md:ml-0 max-md:w-full">
                <div class="flex flex-col grow text-base leading-6 text-black max-md:mt-10">
                  <div class="flex flex-col">
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="w-8 aspect-square" />
                    <div class="flex flex-col mt-4">
                      <h3 class="text-xl font-bold leading-7">Email</h3>
                      <p class="mt-2">Envoyez-nous un email</p>
                      <a href="mailto:hello@pariscaretakerservices.com" class="mt-2 text-black underline">
                        hello@pariscaretakerservices.com
                      </a>
                    </div>
                  </div>
                  <div class="flex flex-col mt-10">
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="w-8 aspect-square" />
                    <div class="flex flex-col mt-4">
                      <h3 class="text-xl font-bold leading-7">Téléphone</h3>
                      <p class="mt-2">Appelez-nous</p>
                      <a href="tel:+33123456789" class="mt-2 text-black underline">+33 (0)1 23 45 67 89</a>
                    </div>
                  </div>
                  <div class="flex flex-col mt-10">
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="w-8 aspect-square" />
                    <div class="flex flex-col mt-4">
                      <h3 class="text-xl font-bold leading-7">Bureau</h3>
                      <p class="mt-2">123 Rue de l'Exemple, Paris 75000 FR</p>
                      <div class="flex flex-col items-start pt-4 mt-2 max-md:pr-5">
                        <a href="#" class="flex gap-2 justify-center">
                          <span>Obtenir l'itinéraire</span>
                          <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-3 aspect-[0.5]" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex flex-col ml-5 w-[68%] max-md:ml-0 max-md:w-full">
                <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="grow w-full aspect-[1.61] max-md:mt-10 max-md:max-w-full" />
              </div>
            </div>
          </section>
        </main>
    </template>
  </nav>
  `,
};