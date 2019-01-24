#include  <opencv2/highgui/highgui.hpp>
#include  <opencv2/imgproc/imgproc.hpp>
#include  <iostream>
#include  <math.h>
#include  <ctime>
#include  <time.h>
#include  <string>
#include  <vector>
#include <iomanip>
#include <string>
#include <cstdio>

using namespace cv;
using namespace std;

#define WINDOW_NAME1
#define WINDOW_NAME2
#define WINDOW_NAME3
#define WINDOW_NAME4
#define WINDOW_NAME5

#define pi 3.1415926


void getoutdot(string& location)
{
    for (decltype(location.size()) index = 0; index != location.size(); ++index)
        location[index] = location[index + 1];
    
}

string getoutimg(string& location,int num)
{
    //    string temp;
    //    for (decltype(location.size()) index = 0; index != location.size() && !isdigit(location[index]); ++index)
    //        temp += location[index];
    //    location = temp;
    
    std::stringstream s;
    std::string msg;
    
    int index;
    std::string temp;
    std::string temp1;
    for(index=0;index <= location.size();++index){
        s<<location[index]<<location[index+1]<<location[index+2]<<location[index+3]<<endl;
        s >> msg;
        if(num==1 || num==2 || num==3)
        {
            if(num==1)
            {
                if(msg==".png" || msg==".jpg" || msg==".jpe"){
                    if(msg==".png"){
                        temp=temp+"_a.png";
                        break;
                    }
                    if(msg==".jpg"){
                        temp=temp+"_a.jpg";
                        break;
                    }
                    if(msg==".jpe"){
                        temp=temp+"_a.jpeg";
                        break;
                    }
                }
                else{
                    temp += location[index];
                }
            }
            if(num==2)
            {
                if(msg==".png" || msg==".jpg" || msg==".jpe"){
                    if(msg==".png"){
                        temp=temp+"_b.png";
                        break;
                    }
                    if(msg==".jpg"){
                        temp=temp+"_b.jpg";
                        break;
                    }
                    if(msg==".jpe"){
                        temp=temp+"_b.jpeg";
                        break;
                    }
                }
                else{
                    temp += location[index];
                }
            }
            if(num==3)
            {
                if(msg==".png" || msg==".jpg" || msg==".jpe"){
                    if(msg==".png"){
                        temp=temp+"_c.png";
                        break;
                    }
                    if(msg==".jpg"){
                        temp=temp+"_c.jpg";
                        break;
                    }
                    if(msg==".jpe"){
                        temp=temp+"_c.jpeg";
                        break;
                    }
                }
                else{
                    temp += location[index];
                }
            }
        }
        
    }
    
    return temp;
}

Mat  rotatesub(string address, double angle)  //返回旋转后的图片大小，角度
{
    Mat rotMat(2, 3, CV_32FC1);
    
    //imshow(WINDOW_NAME1, src);
    //cout << "src.size: " << src.cols << "  " << src.rows << endl;
    
    Mat src = cv::imread(address);
    double x = 0.5*src.cols;
    double y = 0.5*src.rows;
    double z = sqrt(x*x + y*y);
    double t1 = atan(y / x) - fabs(angle) / 180 * pi;
    double t2 = atan(x / y) - fabs(angle) / 180 * pi;
    double r_x = cos(t1)*z;
    double r_y = cos(t2)*z;
    
    
    Mat temp2 = Mat(int(2 * r_y), int(2 * r_x), src.type(), Scalar(255, 255, 255));  //先行后列
    
    Mat imageROI = temp2(Rect(int(r_x - 0.5*src.cols), int(r_y - 0.5*src.rows), src.cols, src.rows));  //先列后行
    addWeighted(imageROI, 0, src, 1, 0., imageROI);
    Point center = Point(temp2.cols / 2, temp2.rows / 2);   //先列后行
    
    
    double scale = 1;
    rotMat = getRotationMatrix2D(center, angle, scale);
    Mat dst = Mat(temp2.cols, temp2.rows, temp2.type(), Scalar(255, 255, 255));;
    warpAffine(temp2, dst, rotMat, temp2.size(), INTER_LINEAR, BORDER_CONSTANT, Scalar(255, 255, 255));
    
    
    imwrite(address, dst);
    src = dst;
    
    return src;
}


string cutsub(int kind, double x, double y, double width, double height, string address, int degree, double standarddx, double standarddy)
{
    int degree1=-degree;
    Mat src = rotatesub(address, degree1);
    std::stringstream s;
    std::string str1;
    double width1=width;
    double height1=height;
    
    switch (kind)
    {
        case 1:
        {
            
            double x1 = src.cols;
            double y1= src.rows;
            
            if(x+width>x1 || y+height>y1){
                x=0;
                y=0;
                width1= src.cols;
                height1=src.rows;
            }
            
            Mat dst = src(Rect(x, y, width1, height1));
            imwrite(address, dst);
            double x_rotation = width1 / standarddx;
            double y_rotation = height1 / standarddy;
            getoutdot(address);
            
            time_t nowtime = time(NULL);
            tm *p = localtime(&nowtime);
            std::stringstream ss;
            std::string str;
            ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
            ss >> str;
            std::stringstream s;
            std::string str1;
            s << setprecision(3)<<x_rotation << "," << setprecision(3)<<y_rotation <<  "," << address<< endl;
            s >> str1;
            return str1;
            break;
        };
            
        case 2:
        {
            Mat  dst_1 = src(Rect(0, 0, x, src.rows));
            Mat  dst_2 = src(Rect(x, 0, src.cols - x, src.rows));
            
            //  getoutpng(address,1);
            
            string address1 =  getoutimg(address,1);
            string address2 = getoutimg(address,2);
            imwrite(address1, dst_1);
            imwrite(address2, dst_2);
            double x_rotation1 = x / standarddx;
            double y_rotation1 = src.rows / standarddy;
            double x_rotation2 = (src.cols - x) / standarddx;
            double y_rotation2 = src.rows / standarddy;
            
            
            getoutdot(address1);
            getoutdot(address2);
            
            std::stringstream s;
            std::string str1;
            s <<setprecision(3)<< x_rotation1 << "," << setprecision(3)<< y_rotation1 << "," << address1<< ","<< setprecision(3)<< x_rotation2 << ","<<setprecision(3)<< y_rotation2 << "," << address2 << endl;
            s >> str1;
            
            const char *savePath=address.data();;
            remove(savePath);
            
            return str1;
            break;
        };
            
        case 3:
        {
            Mat  dst_1 = src(Rect(0, 0, x, src.rows));
            Mat  dst_2 = src(Rect(x, 0, width, src.rows));
            Mat  dst_3 = src(Rect(x + width, 0, src.cols - x - width, src.rows));
            string address1 =getoutimg(address,1);
            string address2 = getoutimg(address,2);
            string address3 =getoutimg(address,3);
            imwrite(address1, dst_1);
            imwrite(address2, dst_2);
            imwrite(address3, dst_3);
            
            double x_rotation1 = x / standarddx;
            double y_rotation1 = src.rows / standarddy;
            double x_rotation2 = width / standarddx;
            double y_rotation2 = src.rows / standarddy;
            double a_rotation3=src.cols - x - width;
            double b_rotation3=standarddx;
            double x_rotation3 = a_rotation3/ b_rotation3;
            double y_rotation3 = src.rows / standarddy;
            
            
            
            time_t nowtime = time(NULL);
            tm *p = localtime(&nowtime);
            std::stringstream ss;
            std::string str;
            ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
            ss >> str;
            
            getoutdot(address1);
            getoutdot(address2);
            getoutdot(address3);
            
            std::stringstream s;
            std::string str1;
            s << "," << setprecision(3)<<x_rotation1 << "," <<setprecision(3)<< y_rotation1 << "," << address1<< ","<< setprecision(3)<< x_rotation2 << "," << setprecision(3)<<y_rotation2 << "," << address2<< "," <<setprecision(3)<< x_rotation3 << ","<<setprecision(3)<< y_rotation3 << "," << address3<< endl;
            s >> str1;
            
            const char *savePath=address.data();;
            remove(savePath);
            return str1;
            break;  //
        };
            
            //        case 4:
            //        {
            //            Mat  dst_1 = src(Rect(0, 0, src.cols, x));
            //            Mat  dst_2 = src(Rect(0, x, src.cols, src.rows - x));
            //            getoutpng(address,3);
            //            string address1 = address + "4_a.png";
            //            string address2 = address + "4_b.png";
            //            imwrite(address1, dst_1);
            //            imwrite(address2, dst_2);
            //            double x_rotation1 = src.cols / standarddx;
            //            double y_rotation1 = x / standarddy;
            //            double x_rotation2 = src.cols / standarddx;
            //            double y_rotation2 = src.rows - x / standarddy;
            //
            //
            //            time_t nowtime = time(NULL);
            //            tm *p = localtime(&nowtime);
            //            std::stringstream ss;
            //            std::string str;
            //            ss << p->tm_year + 1900 << p->tm_mon + 1 << p->tm_mday << p->tm_hour << p->tm_min << p->tm_sec << endl;
            //            ss >> str;
            //            std::stringstream s;
            //            std::string str1;
            //            s << degree << "," << x_rotation1 << "," << y_rotation1 << "," << address1 + "?" + str <<"&&"
            //            << x_rotation2 << "," << y_rotation2 << address2 + "?" + str << endl;
            //            s >> str1;
            //
            //            return str1;
            //            break;
            //        };
    }
    return str1;
}


int main(int argc, char** argv)
{
    if(argc!=10)
    {
        exit(0);
    }
    
    int    kind = atoi(argv[1]);
    double   x = atof(argv[2]);
    double   y = atof(argv[3]);
    double   width = atof(argv[4]);
    double   height = atof(argv[5]);
    string  address = argv[6];
    double ang = atof(argv[7]);
    double standarddx = atof(argv[8]);
    double standarddy = atof(argv[9]);
    
    string strmm=cutsub(kind, x, y, width, height, address, ang,  standarddx,  standarddy);
    cout<<strmm<<endl;
    
    return 0;
}

