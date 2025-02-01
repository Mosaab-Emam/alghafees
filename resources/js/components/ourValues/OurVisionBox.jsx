import { staticContext } from "@/utils/contexts";
import { useContext } from "react";
import BoxHeadline from "../BoxHeadline";
import ParagraphContent from "../ParagraphContent";

const OurVisionBox = () => {
    const static_content = useContext(staticContext);

    return (
        <div className="md:absolute relative md:top-auto top-12 lg:left-[24.4rem] md:right-0 lg:right-auto md:left-auto md:-translate-x-1/2 md:-bottom-[20.6rem] ">
            <div className="md:w-[412px] w-full p-8 flex flex-col items-start gap-[10px] flex-shrink-0 glass-effect glass-effect-bg-primary-2 rounded-tl-[70px] rounded-br-[70px] absolute ">
                <div className="w-[343px] flex flex-col items-start gap-6">
                    <div className="flex flex-col items-start gap-4">
                        <BoxHeadline
                            headline={static_content["vision_title"]}
                        />
                        <ParagraphContent>
                            <span
                                dangerouslySetInnerHTML={{
                                    __html: static_content[
                                        "vision_description"
                                    ],
                                }}
                            />
                        </ParagraphContent>
                    </div>

                    <div className="flex flex-col items-start gap-4">
                        <BoxHeadline
                            headline={static_content["message_title"]}
                            reverseColor={true}
                        />
                        <ParagraphContent>
                            <span
                                dangerouslySetInnerHTML={{
                                    __html: static_content[
                                        "message_description"
                                    ],
                                }}
                            />
                        </ParagraphContent>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default OurVisionBox;
