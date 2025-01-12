import { Post } from "@/types";
import BlogCategories from "../../blog/blogCategories/BlogCategories";

export default function BlogDetailsTopBox({ post }: { post: Post }) {
    return (
        <div className="flex md:flex-row flex-col md:gap-0 gap-[49px] xl:mb-[136px] lg:mb-[80px] mb-[50px]">
            <div className="xl:w-[745px] lg:w-[570px] w-[360px] md:h-[447px] h-[213.422px]">
                <img
                    className="w-full h-full object-cover rounded-tl-[100px]"
                    src={
                        post.featured_image
                            ? post.featured_image
                            : "/default-post-image.jpg"
                    }
                    alt={post.title.ar}
                    loading="lazy"
                />
            </div>

            <BlogCategories />
        </div>
    );
}
