import { Event } from "@/types";
import { EventDescriptionSvg } from "../../assets/images/our-events";
import { ParagraphContent } from "../../components";

export default function EventDescriptionBox({ event }: { event: Event }) {
    return (
        <section className="flex md:flex-row flex-col-reverse items-start md:gap-[51px] gap-8">
            <div className=" inline-flex flex-col items-start p-[50px] gap-[10px] rounded-tl-[100px] rounded-br-[100px] border-[5px] border-primary-600 bg-bg-01 mb-[43px]">
                <div className="flex flex-col items-start  gap-[14px]">
                    <h4 className="head-line-h4 text-right text-Black-01">
                        الوصف
                    </h4>

                    <ParagraphContent>{event.description}</ParagraphContent>
                </div>
            </div>

            <div className="md:w-[284px] w-[134px] md:h-auto h-[134px] flex flex-col items-center md:self-auto self-center">
                <EventDescriptionSvg className="md:w-[284px] w-[134px]  md:h-auto h-[134px] " />
            </div>
        </section>
    );
}
