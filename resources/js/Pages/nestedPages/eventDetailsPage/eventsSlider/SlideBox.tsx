import { Event } from "@/types";
import ShowMoreBtn from "../../../../components/ourEvents/ShowMoreBtn";

const SlideBox = ({ item }: { item: Event }) => {
    console.log(item.images);
    return (
        <div className="w-full h-full flex items-start justify-end gap-[10px]">
            <div
                className="w-full h-full  flex justify-center items-start gap-[10px] py-[24px] px-[55px]"
                style={{
                    borderRadius: "50px 0px",
                    background: `linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, #000 100%) , url(${item?.images[0]})  lightgray 50% / cover no-repeat`,
                }}
            >
                <ShowMoreBtn
                    onClick={() =>
                        (window.location.href = `/events/${item.id}`)
                    }
                    position="right-0 top-0"
                />

                <h4 className="lg:pt-[135px] pt-[230px] pb-[24px] pr-[12px] pl-[26px] h-[24px] text-center flex-shrink-0 text-bg-01  head-line-h5">
                    {item.title}
                </h4>
            </div>
        </div>
    );
};

export default SlideBox;
