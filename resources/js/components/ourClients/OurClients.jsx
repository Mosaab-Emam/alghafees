import Container from "../Container";
import TextContentBox from "./TextContentBox";
import SliderBox from "./sliderBox/SliderBox";

const OurClients = () => {
    return (
        <section className="relative lg:mb-[140px]  mb-8">
            <Container>
                <div className="flex lg:flex-row flex-col lg:gap-0 gap-8 justify-between lg:items-center items-start  ">
                    <TextContentBox />
                    <SliderBox />
                </div>
            </Container>
        </section>
    );
};

export default OurClients;
