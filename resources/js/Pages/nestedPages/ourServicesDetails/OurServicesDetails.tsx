import Container from "@/components/Container";
import { BgImage } from "../../../assets/images/our-services";
import ParagraphContent from "../../../components/ParagraphContent";
import { ourServicesData } from "../../../data";

const OurServicesDetails = ({ id: serviceId }: { id: string }) => {
    const currentService = ourServicesData.find(
        (service) => service.id === Number(serviceId)
    );

    return (
        <>
            <section className="md:mt-[211px] mt-[6rem] mb-[85px] relative">
                <Container>
                    <div className="flex md:flex-row flex-col flex-wrap md:items-start items-center md:justify-between gap-8">
                        <div className="md:w-[305px] w-[360px] flex flex-col items-start md:gap-4 gap-0 self-center">
                            <div className="text-[102px] font-normal leading-[142.px] text-right text-primary-600 capitalize">
                                0{currentService?.id}
                            </div>

                            <h2 className=" head-line-h2 text-right text-Black-01">
                                دراسات الجدوى للمشاريع العقارية
                            </h2>
                        </div>

                        <div className="relative lg:w-[478px] w-full md:w-1/2 md:h-full lg:h-[478px]">
                            <div
                                className="lg:w-[478px] w-full md:h-[478px] h-[292.127px] rounded-tl-[100px] rounded-br-[100px]"
                                style={{
                                    background: `linear-gradient(0deg, rgba(0, 0, 0, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%), url(${currentService?.back_image})  50% / cover no-repeat`,
                                }}
                            ></div>

                            <div
                                className="lg:w-[478px] w-full lg:h-[478px] h-full absolute md:top-4 top-3 left-4  z-[-1] rounded-tl-[100px] rounded-br-[100px]"
                                style={{
                                    background: `url(${BgImage})  50% / cover no-repeat`,
                                }}
                            ></div>
                        </div>

                        <div className="md:w-[340px] w-[360px] self-center">
                            <ParagraphContent>
                                إعداد دراسات الجدوى للمشاريع العقارية بطرق
                                احترافية تساعد عمالئنا على اتخاذ القرارات
                                االستثمارية الصحيحة بعد دراسة تلك االستثمارات
                                وخصائصها والتعرف على نقاط القوة والضعف وبذل
                                العناية في دراسة السوق والعوامل المؤثرة على كافة
                                أنواع االستثمارات العقارية المختلفة .
                            </ParagraphContent>
                        </div>
                    </div>
                </Container>
            </section>
        </>
    );
};

export default OurServicesDetails;
