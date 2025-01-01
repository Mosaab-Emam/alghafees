import React from "react";
import { Swiper, SwiperSlide } from "swiper/react";
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import { Autoplay, Navigation, Pagination } from "swiper/modules";
import DownloadReportButton from "./DownloadReportButton";
import { evaluationsData, reportsData } from "../../../data/reportsData";

const TabsContent = ({ activeTab }) => {
	// Helper function to chunk array into groups of 6
	const chunkArray = (arr, size) => {
		return Array.from({ length: Math.ceil(arr.length / size) }, (v, i) =>
			arr.slice(i * size, i * size + size)
		);
	};

	const currentData = activeTab === 0 ? reportsData : evaluationsData;
	const chunkedData = chunkArray(currentData, 6);

	return (
		<div className='relative w-full'>
			<Swiper
				pagination={{
					clickable: true,
					el: ".custom-pagination",
				}}
				autoplay={{
					delay: 3000,
					disableOnInteraction: false,
				}}
				modules={[Navigation, Pagination, Autoplay]}
				className='w-full reports-swiper'>
				{chunkedData.map((chunk, slideIndex) => (
					<SwiperSlide
						key={slideIndex}
						className='grid md:grid-cols-3 grid-cols-1  md:gap-8 gap-4 items-center'>
						{chunk.map((item, index) => (
							<DownloadReportButton
								key={item.id}
								title={item.title}
								file={item.file}
								type={index % 2 === 0 ? "primary" : "btn-outline"}
								radius={"right"}
							/>
						))}
					</SwiperSlide>
				))}
			</Swiper>
			<div className='custom-pagination flex justify-center md:mt-[50px] mt-8'></div>
		</div>
	);
};

export default TabsContent;
