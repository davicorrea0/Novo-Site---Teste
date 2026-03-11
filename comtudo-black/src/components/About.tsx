import { useState } from "react";
import { motion } from "motion/react";
import { Plus, ArrowUpRight } from "lucide-react";

export function About() {
  const [activeCard, setActiveCard] = useState<number | null>(null);

  const handleCardClick = (index: number) => {
    if (window.innerWidth < 1024) {
      setActiveCard(activeCard === index ? null : index);
    }
  };
  const cards = [
    {
      title: "Exclusividade",
      description: "Produtos assinados, itens limitados e marcas de alto destaque.",
      image: "https://images.unsplash.com/photo-1600607686527-6fb886090705?q=80&w=800&auto=format&fit=crop",
    },
    {
      title: "Sofisticação",
      description: "Ambientes projetados para inspirar e elevar o padrão dos seus projetos.",
      image: "https://images.unsplash.com/photo-1600585154526-990dced4db0d?q=80&w=800&auto=format&fit=crop",
    },
    {
      title: "Atendimento Personalizado",
      description: "Consultoria especializada para atender às suas necessidades com excelência.",
      image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=800&auto=format&fit=crop",
    },
    {
      title: "Inovação",
      description: "As últimas tendências mundiais em acabamentos e design de interiores.",
      image: "https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=800&auto=format&fit=crop",
    },
  ];

  return (
    <section id="sobre" className="py-24 px-6 bg-secondary">
      <div className="max-w-7xl mx-auto">
        {/* Header Section */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start mb-16 lg:mb-20">
          {/* Left Column: Title */}
          <div className="lg:col-span-5">
            <div className="flex items-center gap-3 mb-8">
              <span className="w-2 h-2 bg-black/80"></span>
              <span className="text-sm uppercase tracking-widest font-medium text-black/70">SOBRE NÓS</span>
            </div>
            <motion.h2 
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              className="text-3xl md:text-4xl lg:text-[2.5rem] font-bold leading-[1.1] tracking-wide text-[#1a1a1a] uppercase"
            >
              EXCLUSIVIDADE DEIXA DE SER EXCEÇÃO PARA SE TORNAR O SEU PADRÃO.
            </motion.h2>
          </div>
          
          {/* Right Column: Description */}
          <div className="lg:col-span-7 lg:pl-12 pt-0 lg:pt-2">
            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: 0.2 }}
              className="text-base md:text-lg text-gray-600 leading-relaxed font-light space-y-6"
            >
              <p>
                A COMTUDO BLACK é referência em acabamentos de luxo e altíssima qualidade em Guarapuava, reunindo design contemporâneo, marcas exclusivas e uma experiência pensada nos mínimos detalhes.
              </p>
              <p>
                Um espaço premium que oferece acabamentos de altíssima qualidade, assinados por marcas consolidadas e com novidades de mercado.
              </p>
            </motion.div>
          </div>
        </div>

        {/* Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {cards.map((card, index) => (
            <motion.div
              key={index}
              onClick={() => handleCardClick(index)}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: index * 0.1 }}
              className="group relative aspect-[4/5] md:aspect-[3/4] rounded-[2rem] overflow-hidden cursor-pointer bg-[#f5f5f5]"
            >
              {/* Default State (Image) */}
              <div className={`absolute inset-0 transition-opacity duration-500 lg:group-hover:opacity-0 z-10 ${activeCard === index ? 'opacity-0' : 'opacity-100'}`}>
                {/* Background Image */}
                <img 
                  src={card.image} 
                  alt={card.title}
                  className="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                />
                
                {/* Dark Overlay */}
                <div className="absolute inset-0 bg-black/40" />
                
                {/* Gradient Overlay */}
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60" />

                {/* Content */}
                <div className="absolute inset-0 p-6 flex flex-col justify-between">
                  {/* Plus Icon */}
                  <div className="w-10 h-10 rounded-xl border border-white/80 flex items-center justify-center text-white backdrop-blur-sm">
                    <Plus className="w-5 h-5" />
                  </div>

                  {/* Title */}
                  <h3 className="text-white text-xl font-bold tracking-wide">
                    {card.title.split(' ').map((word, i) => (
                      <span key={i} className="block">{word}</span>
                    ))}
                  </h3>
                </div>
              </div>

              {/* Hover State (White Card) */}
              <div className={`absolute inset-0 bg-[#f5f5f5] p-8 flex flex-col justify-center transition-opacity duration-500 lg:group-hover:opacity-100 z-0 ${activeCard === index ? 'opacity-100' : 'opacity-0'}`}>
                <h3 className="text-[#1a1a1a] text-2xl font-bold mb-4 tracking-tight">
                  {card.title}
                </h3>
                <p className="text-gray-600 text-sm leading-relaxed mb-8">
                  {card.description}
                </p>
                <div className="mt-auto flex items-center gap-2 text-xs font-semibold tracking-widest uppercase text-[#1a1a1a]">
                  SAIBA MAIS <ArrowUpRight className="w-4 h-4" />
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
