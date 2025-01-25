import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, Navigation, Pagination } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/react";
import DownloadReportButton from "./DownloadReportButton";

export default function TabsContent({ activeTab, reports, evaluations }) {
    // Helper function to chunk array into groups of 6
    const chunkArray = (arr, size) => {
        return Array.from({ length: Math.ceil(arr.length / size) }, (v, i) =>
            arr.slice(i * size, i * size + size)
        );
    };

    const currentData = activeTab === 0 ? reports : evaluations;
    const chunkedData = chunkArray(currentData, 6);

    return (
        <div className="relative w-full">
            <Swiper
                pagination={{
                    clickable: true,
                    el: ".custom-pagination",
                }}
                autoplay={{
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                }}
                modules={[Navigation, Pagination, Autoplay]}
                className="w-full reports-swiper"
            >
                {chunkedData.map((chunk, slideIndex) => (
                    <SwiperSlide
                        key={slideIndex}
                        className="!grid md:grid-cols-2 lg:grid-cols-3 grid-cols-1  md:gap-8 gap-4 items-center"
                    >
                        {chunk.map((item, index) => (
                            <DownloadReportButton
                                key={item.id}
                                title={item.title}
                                file={item.file}
                                type={
                                    index % 2 === 0 ? "primary" : "btn-outline"
                                }
                                radius={"right"}
                            />
                        ))}
                    </SwiperSlide>
                ))}
            </Swiper>
            <div className="custom-pagination flex justify-center md:mt-[50px] mt-8"></div>
        </div>
    );
}
