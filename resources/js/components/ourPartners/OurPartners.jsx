import "./OurPartners.css";

const OurPartners = ({ data }) => {
    let partners = [];
    if (data.length > 0) {
        while (partners.length <= 100) {
            partners = [...partners, ...data];
        }
    }

    return (
        <section className="pt-10 pb-60 md:w-[1480px] w-full md:pt-24 md:pb-24">
            <div className="relative infinite-scroll-container">
                <div className="flex animate-infinite-scroll">
                    {partners.map((partner, index) => (
                        <div
                            key={index}
                            className="md:min-w-40 min-w-[50px] h-20 md:mx-8 mx-4 "
                        >
                            <img
                                loading="lazy"
                                className="h-full w-full object-scale-down "
                                src={partner}
                                alt={`Partner ${index + 1}`}
                            />
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default OurPartners;
