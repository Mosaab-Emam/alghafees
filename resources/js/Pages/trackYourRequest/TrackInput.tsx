import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import { Button } from "../../components";

const TrackInput = () => {
    const static_content = useContext(staticContext) as Record<string, string>;

    return (
        <form className="h-[71px] flex flex-col justify-center items-center gap-[10px] self-stretch py-[10px] px-[20px] rounded-br-[50px] rounded-tl-[50px] border border-primary-400 bg-bg-01">
            <div className=" flex justify-between items-center self-stretch">
                <input
                    type="email"
                    placeholder={static_content["search_placeholder"]}
                    className="w-full h-full bg-transparent outline-none border-none regular-b1 placeholder:text-Gray-scale-03 text-primary-500 text-right"
                />
                <Button className="flex flex-col justify-center items-center gap-[10px] self-stretch  rounded-br-[25px] rounded-tl-[25px] bg-primary-600 text-[16px] leading-normal font-norma text-bg-01 uppercase">
                    {static_content["btn_text"]}
                </Button>
            </div>
        </form>
    );
};

export default TrackInput;
