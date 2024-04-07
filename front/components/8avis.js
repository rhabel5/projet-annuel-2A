const Avis = {
  template: `
  <nav class="bg-gray-800 text-white p-4">
    <template>
        <section class="flex flex-col px-16 py-20 w-full bg-white max-md:px-5 max-md:max-w-full">
          <div class="mt-8 max-md:max-w-full">
            <div class="flex gap-5 max-md:flex-col max-md:gap-0">
              <div class="flex flex-col w-6/12 max-md:ml-0 max-md:w-full">
                <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="grow w-full aspect-[0.96] max-md:mt-10 max-md:max-w-full" />
              </div>
              <div class="flex flex-col ml-5 w-6/12 max-md:ml-0 max-md:w-full">
                <div class="flex flex-col items-start self-stretch my-auto max-md:mt-10 max-md:max-w-full">
                  <div class="flex gap-1">
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-5 aspect-[1.05] fill-black" />
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-5 aspect-[1.05] fill-black" />
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-5 aspect-[1.05] fill-black" />
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-5 aspect-[1.05] fill-black" />
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 w-5 aspect-[1.05] fill-black" />
                  </div>
                  <blockquote class="self-stretch mt-8 text-2xl font-bold leading-9 text-black max-md:max-w-full">
                    « J'ai utilisé Paris Caretaker Services pour gérer mes propriétés et je suis extrêmement satisfait du service. Ils ont rendu le processus de gestion des réservations et des interactions avec les clients très facile et efficace. Je recommande vivement leurs services. »
                  </blockquote>
                  <div class="flex gap-5 justify-between py-1 mt-8 text-base leading-6 text-black">
                    <div class="flex flex-col my-auto">
                      <cite class="font-semibold">Jean Dupont</cite>
                      <div>Propriétaire, Dupont Properties</div>
                    </div>
                    <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="shrink-0 max-w-full aspect-[2.5] w-[140px]" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex gap-5 justify-between mt-8 mb-2.5 w-full max-md:flex-wrap max-md:max-w-full">
            <div class="flex gap-2 my-auto">
              <div class="shrink-0 w-2 h-2 bg-black rounded-full" aria-hidden="true"></div>
              <div class="shrink-0 w-2 h-2 rounded-full bg-stone-300" aria-hidden="true"></div>
              <div class="shrink-0 w-2 h-2 rounded-full bg-stone-300" aria-hidden="true"></div>
              <div class="shrink-0 w-2 h-2 rounded-full bg-stone-300" aria-hidden="true"></div>
              <div class="shrink-0 w-2 h-2 rounded-full bg-stone-300" aria-hidden="true"></div>
            </div>
            <div class="flex gap-4">
              <button class="flex justify-center items-center p-3 border border-black border-solid rounded-[50px]">
                <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="w-6 aspect-square" />
              </button>
              <button class="flex justify-center items-center p-3 border border-black border-solid rounded-[50px]">
                <img loading="lazy" src="../assets/images/test.jpg" alt="Image de villa" class="w-6 aspect-square" />
              </button>
            </div>
          </div>
        </section>
    </template>
  </nav>
  `,
};