  <section id="contacto" class="bg-gray-100 py-16">
      <div class="max-w-screen-md mx-auto px-4 text-center">
          <h2 class="text-3xl font-bold text-gray-900 mb-6">Fale Connosco</h2>
          <p class="text-gray-600 mb-8">Tem dúvidas? Envia-nos uma mensagem.</p>

          <form id="contactForm" class="space-y-4 text-left">
              <div>
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nome</label>
                  <input type="text" id="name" name="name" placeholder="Seu nome completo"
                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600">
              </div>

              <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-700">E-mail</label>
                  <input type="email" id="email" name="email" placeholder="seu@email.com"
                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600">
              </div>

              <div>
                  <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Mensagem</label>
                  <textarea id="message" name="message" rows="4" placeholder="Escreva sua mensagem..."
                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600"></textarea>
              </div>

              <button type="submit"
                  class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-medium">Enviar
                  Mensagem</button>
          </form>
      </div>
  </section>
