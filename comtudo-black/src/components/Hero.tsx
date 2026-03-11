import { useRef } from "react";
import { motion, useScroll, useTransform } from "motion/react";
import { ArrowDown } from "lucide-react";

export function Hero() {
  const containerRef = useRef<HTMLElement>(null);
  const { scrollYProgress } = useScroll({
    target: containerRef,
    offset: ["start start", "end start"]
  });

  const y = useTransform(scrollYProgress, [0, 1], ["0%", "30%"]);
  const scale = useTransform(scrollYProgress, [0, 1], [1.1, 1.2]);

  return (
    <section ref={containerRef} className="h-[calc(85vh+50px)] min-h-[600px] w-full flex items-center justify-center p-4 md:p-6 relative">
      {/* Background Split */}
      <div className="absolute inset-0 z-0 bg-gradient-to-b from-[#2D2D2D] from-75% to-[#DADADA] to-75%" />

      <div className="relative z-10 w-full max-w-[1854px] h-full rounded-[2.5rem] overflow-hidden bg-[#1a1a1a] shadow-2xl">
        {/* Background Image */}
        <div className="absolute inset-0 z-0 overflow-hidden">
          <motion.div
            animate={{ scale: [1, 1.05, 1] }}
            transition={{ duration: 20, ease: "easeInOut", repeat: Infinity }}
            className="w-full h-full"
          >
            <motion.img 
              initial={{ scale: 1.2 }}
              animate={{ scale: 1 }}
              style={{ y, opacity: 0.8 }}
              transition={{ duration: 1.5, ease: [0.76, 0, 0.24, 1] }}
              src="https://images.unsplash.com/photo-1600607686527-6fb886090705?q=80&w=2700&auto=format&fit=crop" 
              alt="Luxury Interior" 
              className="w-full h-full object-cover"
            />
          </motion.div>
          {/* Gradient Overlay - Stronger on the left */}
          <div className="absolute inset-0 bg-gradient-to-r from-[#1a1a1a] via-[#1a1a1a]/80 to-transparent z-10" />
        </div>

        {/* Content */}
        <div className="relative z-20 h-full flex flex-col justify-center px-8 md:px-12 lg:px-24">
          <div className="max-w-5xl mt-32 md:mt-24 lg:mt-0">
            <h1 className="text-white text-[clamp(1.75rem,6.5vw,8rem)] leading-[0.85] tracking-tight mb-8 py-2 flex flex-row items-baseline gap-x-3 md:gap-x-6 whitespace-nowrap">
              <span className="overflow-hidden block">
                <motion.span 
                  initial={{ y: "100%" }}
                  animate={{ y: 0 }}
                  transition={{ duration: 1, ease: [0.16, 1, 0.3, 1], delay: 0.6 }}
                  className="font-heading font-medium block text-left"
                >
                  COMTUDO
                </motion.span>
              </span>
              <span className="overflow-hidden block">
                <motion.span 
                  initial={{ y: "100%" }}
                  animate={{ y: 0 }}
                  transition={{ duration: 1, ease: [0.16, 1, 0.3, 1], delay: 0.7 }}
                  className="font-heading font-light block text-left"
                >
                  BLACK
                </motion.span>
              </span>
            </h1>
            
            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 1, ease: "easeOut", delay: 1.0 }}
              className="flex flex-col items-start gap-8 md:gap-12 mt-12 md:mt-24 lg:mt-32 md:ml-2"
            >
              <p className="text-white/80 text-xl md:text-2xl lg:text-[28px] font-light tracking-wide max-w-md">
                No padrão das suas escolhas.
              </p>

              <motion.a 
                href="#sobre"
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
                className="flex items-center gap-6 text-white group cursor-pointer"
              >
                <div className="w-12 h-12 md:w-14 md:h-14 rounded-2xl border-[1.5px] border-white/60 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-300">
                  <ArrowDown className="w-5 h-5 md:w-6 md:h-6" />
                </div>
                <span className="text-xs md:text-sm uppercase tracking-[0.2em] font-medium text-white/80">Saiba Mais</span>
              </motion.a>
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
}
