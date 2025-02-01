import Container from "@/components/Container";
import ServicesImages from "../../components/ourServices/ServicesImages";
import BoxOne from "./BoxOne";
import OurRealStateServices from "./ourRealStateServices/OurRealStateServices";

const ServicesMainContent = () => {
    return (
        <Container>
            <section className="md:mt-[211px] mt-[6rem]">
                <BoxOne />
                <ServicesImages />
                <OurRealStateServices />
            </section>
        </Container>
    );
};

export default ServicesMainContent;
