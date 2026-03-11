import { useState } from "react";
import { motion } from "motion/react";
import { Play } from "lucide-react";
import { Plyr } from "plyr-react";
import "plyr-react/plyr.css";

export function VideoSection() {
  const [isPlaying, setIsPlaying] = useState(false);

  return (
    <section className="pt-32 pb-20 px-6 bg-secondary">
      <div className="max-w-[1310px] mx-auto">
        {!isPlaying ? (
          <motion.div 
            // onClick={() => setIsPlaying(true)} // Descomente quando tiver o vídeo oficial
            initial={{ opacity: 0, scale: 0.95 }}
            whileInView={{ opacity: 1, scale: 1 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="relative w-full h-[300px] md:h-[350px] lg:h-[427px] rounded-3xl overflow-hidden shadow-2xl group transition-transform duration-300"
          >
            <img 
              src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2500&auto=format&fit=crop" 
              alt="Video Thumbnail" 
              className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 blur-sm"
            />
            <div className="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors">
              <div className="absolute bottom-6 left-6 md:bottom-8 md:left-8 w-12 h-12 md:w-14 md:h-14 rounded-2xl border-[1.5px] border-white flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <Play className="w-5 h-5 md:w-6 md:h-6 text-white fill-white ml-1" />
              </div>
            </div>
          </motion.div>
        ) : (
          <motion.div 
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            className="w-full rounded-3xl overflow-hidden shadow-2xl bg-black"
          >
            <Plyr 
              source={{
                type: 'video',
                sources: [
                  {
                    src: 'https://cdn.plyr.io/static/blank.mp4',
                    type: 'video/mp4',
                    size: 720,
                  },
                ],
                poster: 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2500&auto=format&fit=crop',
              }}
              options={{
                autoplay: true,
                controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
              }}
            />
          </motion.div>
        )}
      </div>
    </section>
  );
}
