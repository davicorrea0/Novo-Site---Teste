import { MapPin, ExternalLink, Navigation } from "lucide-react";

export function Location() {
  const mapUrl = "https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR";
  const directionsUrl = "https://www.google.com/maps/dir/?api=1&destination=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR";

  return (
    <section id="localizacao" className="pt-24 pb-0 px-6 bg-[#DADADA] relative">
      <div className="max-w-7xl mx-auto text-center mb-12 relative z-10">
        <h2 className="text-3xl md:text-4xl font-bold uppercase tracking-widest mb-2 text-black">ONDE ESTAMOS</h2>
        <p className="text-black/60 text-sm tracking-wide uppercase">VISITE O ENDEREÇO DA EXCLUSIVIDADE.</p>
      </div>

      <div className="max-w-[1310px] mx-auto relative h-[500px] lg:h-[427px] rounded-[2rem] overflow-hidden shadow-2xl group -mb-24 z-20">
        {/* Interactive Google Map */}
        <div className="absolute inset-0 bg-[#1a1a1a] overflow-hidden pointer-events-none">
          <iframe 
            src="https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR&t=&z=18&ie=UTF8&iwloc=near&output=embed" 
            className="absolute -top-[150px] left-0 w-full h-[calc(100%+300px)]"
            style={{ border: 0, filter: "grayscale(100%) invert(90%) contrast(1.2)" }} 
            allowFullScreen={false} 
            loading="lazy" 
            referrerPolicy="no-referrer-when-downgrade"
            title="Localização Comtudo Black"
          ></iframe>
          {/* Overlay to ensure it blends well with the dark theme and prevents scrolling issues if needed, remove pointer-events-none if you want full interaction */}
          <div className="absolute inset-0 bg-[#1a1a1a]/20 pointer-events-none mix-blend-multiply"></div>
        </div>

        {/* Address Card */}
        <div className="absolute bottom-6 lg:bottom-12 left-4 right-4 lg:right-auto lg:left-12 bg-white/95 backdrop-blur-md p-6 md:p-8 rounded-2xl shadow-2xl max-w-none lg:max-w-md border border-black/5">
            <div className="flex flex-col gap-4">
                <div>
                  <h3 className="font-bold text-xl text-black mb-1">Comtudo Black</h3>
                  <p className="text-black/70 text-sm md:text-base leading-relaxed">
                      Rua Laurindo Richa, 304, <br />
                      Guarapuava - Paraná
                  </p>
                </div>
                
                <div className="flex items-center gap-3 pt-2 border-t border-black/10 mt-2">
                  <a 
                    href={directionsUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="flex-1 flex items-center justify-center gap-2 bg-black text-white py-2.5 px-4 rounded-xl text-sm font-medium hover:bg-black/80 transition-all active:scale-95"
                  >
                    <Navigation className="w-4 h-4" />
                    Rotas
                  </a>
                  <a 
                    href={mapUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="flex items-center justify-center gap-2 bg-black/5 text-black py-2.5 px-4 rounded-xl text-sm font-medium hover:bg-black/10 transition-all active:scale-95"
                    title="Ver mapa maior"
                  >
                    <ExternalLink className="w-4 h-4" />
                    Ampliar
                  </a>
                </div>
            </div>
        </div>
      </div>
    </section>
  );
}
