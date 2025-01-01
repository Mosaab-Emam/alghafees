import React from "react";

// Import Swiper React components
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import "swiper/css/free-mode";
import { Autoplay, FreeMode } from "swiper/modules";

import BlogCard from "../../../blog/blogsBox/BlogCard";
import { blogsData } from "../../../../data/blogData";

const RelatedSlidBox = ({ className, swiperRef }) => {
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
				className='mySwiper w-full relative '>
				{[...blogsData, ...blogsData, ...blogsData, ...blogsData].map(
					(item) => (
						<SwiperSlide
							className='2xl:!w-[420px] xl:!w-[387px] lg:w-[380px] !w-[360px] !h-full md:py-4 py-2'
							key={item.id}>
							<BlogCard isLatestTopic={true} key={item.id} blog={item} />
						</SwiperSlide>
					)
				)}
			</Swiper>
		</section>
	);
};

export default RelatedSlidBox;
