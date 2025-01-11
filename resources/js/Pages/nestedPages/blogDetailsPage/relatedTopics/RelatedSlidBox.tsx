// Import Swiper React components
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, FreeMode } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";

import { Post } from "@/types";
import BlogCard from "../../../blog/blogsBox/BlogCard";

export default function RelatedSlidBox({
    posts,
    className,
    swiperRef,
}: {
    posts: Array<Post>;
    className?: string;
    swiperRef: any;
}) {
    return (
        <section className={`${className} 2xl:w-[1289px] xl:w-[1220px] w-full`}>
            <Swiper
                onBeforeInit={(swiper) => {
                    swiperRef.current = swiper;
                }}
                autoplay={{
                    delay: 4000,
                    disableOnInteraction: false,
                }}
                breakpoints={{
                    320: {
                        slidesPerView: 1.9,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 1.9,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 3.2,
                        spaceBetween: 20,
                    },
                }}
                centeredSlides={true}
                spaceBetween={20}
                loop={true}
                freeMode={true}
                modules={[Autoplay, FreeMode]}
                className="mySwiper w-full relative "
            >
                {posts.map((post) => (
                    <SwiperSlide
                        className="2xl:!w-[420px] xl:!w-[387px] lg:w-[380px] !w-[360px] !h-full md:py-4 py-2"
                        key={post.id}
                    >
                        <BlogCard
                            isLatestTopic={true}
                            key={post.id}
                            post={post}
                        />
                    </SwiperSlide>
                ))}
            </Swiper>
        </section>
    );
}
