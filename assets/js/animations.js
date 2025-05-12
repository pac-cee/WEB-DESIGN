// Animation Utilities
export const animate = {
  fadeIn: (element, duration = 300) => {
    element.style.opacity = '0';
    element.style.display = 'block';
    
    requestAnimationFrame(() => {
      element.style.transition = `opacity ${duration}ms ease`;
      element.style.opacity = '1';
    });
    
    return new Promise(resolve => {
      setTimeout(resolve, duration);
    });
  },
  
  fadeOut: (element, duration = 300) => {
    element.style.opacity = '1';
    
    requestAnimationFrame(() => {
      element.style.transition = `opacity ${duration}ms ease`;
      element.style.opacity = '0';
    });
    
    return new Promise(resolve => {
      setTimeout(() => {
        element.style.display = 'none';
        resolve();
      }, duration);
    });
  },
  
  slideDown: (element, duration = 300) => {
    element.style.height = '0';
    element.style.overflow = 'hidden';
    element.style.display = 'block';
    
    const height = element.scrollHeight;
    
    requestAnimationFrame(() => {
      element.style.transition = `height ${duration}ms ease`;
      element.style.height = `${height}px`;
    });
    
    return new Promise(resolve => {
      setTimeout(() => {
        element.style.height = 'auto';
        element.style.overflow = 'visible';
        resolve();
      }, duration);
    });
  },
  
  slideUp: (element, duration = 300) => {
    element.style.height = `${element.scrollHeight}px`;
    element.style.overflow = 'hidden';
    
    requestAnimationFrame(() => {
      element.style.transition = `height ${duration}ms ease`;
      element.style.height = '0';
    });
    
    return new Promise(resolve => {
      setTimeout(() => {
        element.style.display = 'none';
        resolve();
      }, duration);
    });
  },
  
  shake: (element, distance = 10, duration = 500) => {
    const keyframes = [
      { transform: 'translateX(0)' },
      { transform: `translateX(${distance}px)` },
      { transform: `translateX(-${distance}px)` },
      { transform: `translateX(${distance/2}px)` },
      { transform: `translateX(-${distance/2}px)` },
      { transform: 'translateX(0)' }
    ];
    
    return element.animate(keyframes, {
      duration,
      easing: 'ease-in-out'
    }).finished;
  },
  
  pulse: (element, scale = 1.05, duration = 200) => {
    const keyframes = [
      { transform: 'scale(1)' },
      { transform: `scale(${scale})` },
      { transform: 'scale(1)' }
    ];
    
    return element.animate(keyframes, {
      duration,
      easing: 'ease-in-out'
    }).finished;
  }
};

// Intersection Observer Animations
export const createScrollAnimation = (options = {}) => {
  const defaultOptions = {
    threshold: 0.2,
    animation: 'fade-in',
    once: true
  };
  
  const config = { ...defaultOptions, ...options };
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add(config.animation);
        if (config.once) {
          observer.unobserve(entry.target);
        }
      } else if (!config.once) {
        entry.target.classList.remove(config.animation);
      }
    });
  }, {
    threshold: config.threshold
  });
  
  return {
    observe: (element) => observer.observe(element),
    unobserve: (element) => observer.unobserve(element)
  };
};

// Page Transition
export const pageTransition = {
  init: () => {
    document.body.style.opacity = '0';
    requestAnimationFrame(() => {
      document.body.style.transition = 'opacity 300ms ease';
      document.body.style.opacity = '1';
    });
  },
  
  exit: () => {
    return new Promise(resolve => {
      document.body.style.opacity = '0';
      setTimeout(resolve, 300);
    });
  }
};

// Loading Indicators
export const loading = {
  spinner: () => {
    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner';
    return spinner;
  },
  
  dots: () => {
    const dots = document.createElement('div');
    dots.className = 'loading-dots';
    dots.innerHTML = '<span></span><span></span><span></span>';
    return dots;
  }
};

// Initialize Animations
document.addEventListener('DOMContentLoaded', () => {
  // Add scroll animations to elements
  const scrollAnimation = createScrollAnimation();
  document.querySelectorAll('[data-animate]').forEach(element => {
    scrollAnimation.observe(element);
  });
  
  // Initialize page transition
  pageTransition.init();
  
  // Add hover animations to cards
  document.querySelectorAll('.card').forEach(card => {
    card.classList.add('hover-lift');
  });
  
  // Add button click animations
  document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', () => {
      animate.pulse(button);
    });
  });
});

// Export animation utilities
export default {
  animate,
  createScrollAnimation,
  pageTransition,
  loading
};